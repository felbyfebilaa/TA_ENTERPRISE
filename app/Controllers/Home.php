<?php

namespace App\Controllers;

use App\Models\customer;
use App\Models\paketFoto;
use App\Models\PaketMakeup;
use App\Models\rekening;
use App\Models\reservasi;
use App\Models\reservasis;
use App\Models\transaksi;
use App\Models\transaksis;
use App\Models\Pembayaran;
use App\Models\Ulasan;
use App\Models\Galeri;
use CodeIgniter\API\ResponseTrait;
use Dompdf\Dompdf;

class Home extends BaseController
{
    use ResponseTrait;
    protected $Paket;
    protected $PaketMakeup;
    protected $Rekening;
    protected $Customer;
    protected $Reservasi;
    protected $Reservasis;
    protected $Transaksi;
    protected $Transaksis;
    protected $Pembayaran;
    protected $Ulasan;
    protected $Galeri;

    public function __construct()
    {
        $this->PaketMakeup = new PaketMakeup();
        $this->Paket = new paketFoto();
        $this->Rekening = new rekening();
        $this->Customer = new customer();
        $this->Reservasi = new reservasi();
        $this->Reservasis = new reservasis();
        $this->Transaksi = new transaksi();
        $this->Transaksis = new transaksis();
        $this->Pembayaran = new Pembayaran();
        $this->Ulasan = new Ulasan();
        $this->Galeri = new Galeri();
    }

    public function index()
    {
//         ====================== hit Api open wheatermap =========================
        $apiKey = '206891d8d1f76531c0fe6f1702cc8312';
        $city = 'Payakumbuh';
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}";

        $client = \Config\Services::curlrequest();
//        ======================== sampai sini =====================================

        try {
            $response = $client->get($apiUrl);
            $dataCuaca = json_decode($response->getBody(), true);

        } catch (RequestException $e) {
            echo "Error: " . $e->getMessage();
        }


        $data = [
            'paket' => $this->PaketMakeup->getPaket(),
            'galeri' => $this->Galeri->getGaleri(),
            'cuaca' => $dataCuaca

        ];
        return view('Home/index', $data);
    }

    public function reservasi($id)
    {
        $data = [
            'paket'         => $this->Paket->where('id_paket', $id)->first(),
            'rekenings'     => $this->Rekening->findAll(),
            'validasi'      => \Config\Services::validation()
        ];
        return view('Home/reservasi', $data);
    }

    public function reservasis($id)
    {
        $data = [
            'paket'         => $this->PaketMakeup->where('id_paket_makeup', $id)->first(),
            'rekenings'     => $this->Rekening->findAll(),
            'validasi'      => \Config\Services::validation()
        ];
        return view('Home/reservasis', $data);
    }

    public function ulasan($id)
    {
        $data = [
            'paket'         => $this->PaketMakeup->where('id_paket_makeup', $id)->first(),
            'validasi'      => \Config\Services::validation()
        ];
        return view('Home/ulasan', $data);
    }

    public function getNoRek($id)
    {
        $data = $this->Rekening->getRekenig($id);

        return $this->respond($data);
    }

    public function insertReservasis()
    {
        $id_paket = $_POST['id'];
        // echo $_SERVER['HTTP_REFERER'];
        if ($_SERVER['HTTP_REFERER'] == "http://localhost:8080/index.php/Home/reservasi/$id_paket") {
            $string = explode('http://localhost:8080/index.php', $_SERVER['HTTP_REFERER']);
        } else if ($_SERVER['HTTP_REFERER'] == "http://localhost:8080/Home/reservasi/$id_paket") {
            $string = explode('http://localhost:8080', $_SERVER['HTTP_REFERER']);
        }


        $nama = $this->request->getVar('nama');
        $nikPelanggan = $this->request->getVar('nik');
        $dataCustomer = $this->Customer->isRegistered($nama, $nikPelanggan);
        $bool = (int)$dataCustomer[0]['data'];
        $cekCostumer = $this->Customer->isCekCostumer($nama, $nikPelanggan);

        $nik = $this->Customer->checkNIK($nikPelanggan);
        $bool2 = (int)$nik[0]['data'];
        // var_dump($string);
        // exit;
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama tidak boleh kosong'
                ]
            ],
            'nik' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'NIK tidak boleh kosong',
                ]
            ],
            'no_hp' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'No Telepon tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Alamat tidak boleh kosong',
                ]
            ],
            'tanggal_booking' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Tanggal Booking tidak boleh kosong',
                ]
            ],
            'tanggal_makeup' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Tanggal Makeup tidak boleh kosong',
                ]
            ],
            'waktu_makeup' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Waktu Makeup tidak boleh kosong',
                ]
            ],
            'alamat_makeup' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Alamat Makeup tidak boleh kosong',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Jumlah Pembayaran tidak boleh kosong',
                ]
            ],
            'jenis_pembayaran' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Jenis Pembayaran tidak boleh kosong',
                ]
            ],
            'bukti_pembayaran' => [
                'rules' => 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,10240]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload bukti transaksi',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', 'periksa kembali data anda');
            return redirect()->to("Home/reservasis/" . $id_paket)->withInput();
        }


        if (!empty($cekCostumer['id_costumer'])) {
            $stat = "b";
            $idCostumer = $cekCostumer['id_costumer'];
        } else {
            $stat = "c";
            $data = [
                'Nama'      => $this->request->getVar('nama'),
                'NIK'       => $this->request->getVar('nik'),
                'No_HP'     => $this->request->getVar('no_hp'),
                'Alamat'    => $this->request->getVar('alamat')
            ];
            $this->Customer->insert($data);
            $idCostumer = $this->Customer->insertID();
        }

        $filetransaksi = $this->request->getFile('bukti_pembayaran');
        $namafile = $filetransaksi->getRandomName();
        $filetransaksi->move('assets/bukti_transaksi', $namafile);

        $data2 = [
            'id_rekening'  => $this->request->getVar('jenis_pembayaran'),
            'tanggal_pembayaran'=> date('Y-m-d'),
            'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran'),
            'biaya_admin'    => $this->request->getVar('biaya_admin'),
            'total_pembayaran'    => $this->request->getVar('subtotal'),
            'bukti_transaksi'    => $namafile,
            'id_costumer'    => $idCostumer,
        ];
        $this->Pembayaran->insert($data2);
        $idPembayaran = $this->Pembayaran->insertID();

//        var_dump($idCostumer);
//        exit;

        $this->Reservasis->insert([
            'NIK'                   => $nikPelanggan,
            'id_costumer'           => $idCostumer,
            'id_pembayaran'           => $idPembayaran,
            'id_paket_makeup'       => $id_paket,
            'tanggal_booking'       => $this->request->getVar('tanggal_booking'),
            'tanggal_makeup'        => $this->request->getVar('tanggal_makeup'),
            'waktu_makeup'          => $this->request->getVar('waktu_makeup'),
            'alamat_makeup'         => $this->request->getVar('alamat_makeup'),
            'status_booking'        => 'Menunggu'
        ]);
        $idReserrvasi = $this->Reservasis->insertID();

        $this->Transaksis->save([
            'id_reservasi'  => $idReserrvasi,
            'id_pembayaran' => $idPembayaran,
            'id_costumer' => $idCostumer,
            'tanggal_transaksi'   => $this->request->getVar('tanggal_booking')
        ]);

        $idTransaksi = $this->Transaksis->insertID();

        session()->setFlashdata('idTransaksi', $idTransaksi);
        session()->set('idTransaksi', $idTransaksi);
        return redirect()->to('Home/transaksiBerhasil/');
        // return redirect("Home/transaksiBerhasil/$idTransaksi");
    }

    public function insertUlasan()
    {
        $id_paket = $_POST['id'];
        // echo $_SERVER['HTTP_REFERER'];
        if ($_SERVER['HTTP_REFERER'] == "http://localhost:8080/index.php/Home/reservasi/$id_paket") {
            $string = explode('http://localhost:8080/index.php', $_SERVER['HTTP_REFERER']);
        } else if ($_SERVER['HTTP_REFERER'] == "http://localhost:8080/Home/reservasi/$id_paket") {
            $string = explode('http://localhost:8080', $_SERVER['HTTP_REFERER']);
        }


        $nama_costumer = $this->request->getVar('nama_costumer');
        $ulasan = $this->request->getVar('ulasan');
        $tanggal_ulasan = date('Y-m-d');

        if (!$this->validate(
            [
                'nama_costumer' => [
                    'rules' => 'required',
                    'errors'    => [
                        'required'  => 'Nama tidak boleh kosong'
                    ]
                ],
                'ulasan' => [
                    'rules' => 'required',
                    'errors'    => [
                        'required'  => 'NIK tidak boleh kosong',
                    ]
                ],
            ])
        ) {
            session()->setFlashdata('pesan', 'periksa kembali data anda');
            return redirect()->to("Home/ulasan/" . $id_paket)->withInput();
        }

        $data = [
            'nama_costumer' => $nama_costumer,
            'id_paket_makeup'=> $id_paket,
            'ulasan'        => $ulasan,
            'tanggal_ulasan'=> $tanggal_ulasan,
        ];
        $this->Ulasan->insert($data);

        return redirect()->to('Home/index');
        // return redirect("Home/transaksiBerhasil/$idTransaksi");
    }

    public function transaksiBerhasil()
    {
        $id = session()->get('idTransaksi');
        $dataTransaksi = $this->Transaksis->successData($id);

        $data = [
            'transaksi' => $dataTransaksi
        ];
        return view('Home/success', $data);
    }

    public function cari($input = '')
    {
        $data = $this->Customer->findCustomer($input);

        return $this->respond($data);
    }

    public function printTransaksi($id)
    {
        $dompdf = new Dompdf();
        $data = [
            'transaksi' => $this->Transaksis->successData($id)
        ];
        $dataTransaksi = $this->Transaksis->successData($id);
        $nama = $dataTransaksi['Nama'];
        $file = "Tagihan $nama";
        $view = view('Home/print', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A5', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($file);
    }
}
