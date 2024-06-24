<?php

namespace App\Controllers;

use App\Models\admin as ModelsAdmin;
use App\Models\customer;
use App\Models\PaketMakeup;
use App\Models\paketFoto;
use App\Models\rekening;
use App\Models\reservasi;
use App\Models\reservasis;
use App\Models\Pembayaran;
use App\Models\transaksi;
use App\Models\transaksis;
use App\Models\Ulasan;
use App\Models\Galeri;
use Config\Database;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected $Admin;
    protected $Customer;
    protected $PaketMakeup;
    protected $Paket;
    protected $Reservasi;
    protected $Reservasis;
    protected $Transaksi;
    protected $Transaksis;
    protected $Rekening;
    protected $Pembayaran;
    protected $Ulasan;
    protected $Galeri;

    public function __construct()
    {
        $this->Admin = new ModelsAdmin();
        $this->Customer = new customer();
        $this->PaketMakeup = new PaketMakeup();
        $this->Paket = new paketFoto();
        $this->Reservasi = new reservasi();
        $this->Reservasis = new reservasis();
        $this->Transaksi = new transaksi();
        $this->Transaksis = new transaksis();
        $this->Rekening = new rekening();
        $this->Pembayaran = new Pembayaran();
        $this->Ulasan = new Ulasan();
        $this->Galeri = new Galeri();
    }

    public function login()
    {
        return view('Admin/login');
    }

    public function loginAuth()
    {
        $sess = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Get password And Verify Password
        $verify = $this->Admin->where('username', $username)->first();
        if ($verify) {
            $pass = $verify['password'];
            $verifypassword = password_verify($password, $pass);

            if ($verifypassword) {
                $sessdata = [
                    'username'   => $verify['username'],
                ];

                $sess->set($sessdata);
                return redirect()->to('Admin/index');
            } else {
                $sess->setFlashdata('pesan1', 'password yang anda masukan salah');
                return redirect()->to('Admin/login');
            }
        } else {
            $sess->setFlashdata('pesan2', 'email ini tidak terdaftar');
            return redirect()->to('Admin/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('Admin/login');
    }

    public function index()
    {
        if (session()->get('username') != null || session()->get('username') != '') {
            $data = [
                'title' => 'Dashboard',
                'header'    => 'Dashboard',
                'paket'     => $this->PaketMakeup->countPaket(),
                'customer'  => $this->Customer->countCustomer(),
                'transaksi' => $this->Transaksi->countTransaksi(),
                'data'      => $this->Reservasis->getReservasi(),
                'status'   => count($this->Reservasis->doneStatus()),
                'statusPending'   => count($this->Reservasis->pendingStatus()),
            ];

            return view('Admin/index', $data);
        } else {
            return redirect()->to('Admin/login');
        }
    }

    public function customer()
    {
        $data = [
            'title' => 'Customer',
            'header'    => 'Customer',
            'customers' => $this->Customer->findAll(),
            'validasi'  => \Config\Services::validation()
        ];

        return view('Admin/pelanggan', $data);
    }

    public function insertCustomer()
    {
        if (!$this->validate([
            'nama'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'nama harus diisi'
                ]
            ],
            'nik'  => [
                'rules' => 'required|is_unique[customer.NIK]',
                'errors'    => [
                    'required'  => 'nik harus diisi',
                    'is_unique' => 'nik ini sudah terdaftar'
                ]
            ],
            'notelp'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'no telepon harus diisi'
                ]
            ],
            'alamat'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'alamat harus diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan eror', 'customer berhasil gagal ditambahkan');
            return redirect()->to('Admin/customer')->withInput();
        }

        $this->Customer->save([
            'Nama'  => $this->request->getVar('nama'),
            'NIK'  => $this->request->getVar('nik'),
            'No_HP'  => $this->request->getVar('notelp'),
            'Alamat'  => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'customer berhasil ditambahkan');
        return redirect()->to('Admin/customer');
    }

    public function updateCustomer($nik)
    {
        // var_dump($nik);
        // exit;
        if (!$this->validate([
            'nama'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'nama harus diisi'
                ]
            ],
            'notelp'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'no telepon harus diisi'
                ]
            ],
            'alamat'  => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'alamat harus diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan eror', 'customer berhasil gagal diupdate');
            return redirect()->to('Admin/customer')->withInput();
        }


        $data = [
            'Nama'  => $this->request->getVar('nama'),
            'No_HP'  => $this->request->getVar('notelp'),
            'Alamat'  => $this->request->getVar('alamat')
        ];
        $this->Customer->set($data);
        $this->Customer->where('NIK', $nik);
        $this->Customer->update();
        // $this->Customer->where('NIK', $nik);
        // $this->Customer->save([
        //     'Nama'  => $this->request->getVar('nama'),
        //     'NIK'  => $nik,
        //     'No_HP'  => $this->request->getVar('notelp'),
        //     'Alamat'  => $this->request->getVar('alamat')
        // ]);

        session()->setFlashdata('pesan', 'customer berhasil diupdate');
        return redirect()->to('Admin/customer');
    }

    public function deleteCustomer($nik)
    {
        $data = $this->Reservasi->where('NIK', $nik)->first();
        if ($data != null) {
            $this->Transaksi->where('Id_Reservasi', $data['Id_Reservasi']);
            $this->Transaksi->delete();

            $this->Reservasi->where('NIK', $nik);
            $this->Reservasi->delete();
        }


        $this->Customer->where('NIK', $nik);
        $this->Customer->delete();
        session()->setFlashdata('pesan', 'customer, transaksi customer, reservasi customer berhasil dihapus');
        return redirect()->to('Admin/customer');
    }

    public function paketMakeup()
    {
        $data = [
            'title' => 'Paket Make Up',
            'header'    => 'Paket Make Up',
            'validasi'  => \Config\Services::validation(),
            'paketMakeup'    => $this->PaketMakeup->getPaket()
        ];

        return view('Admin/paketMakeup', $data);
    }

    public function insertPaketMakeup()
    {

        if (!$this->validate([
            'nama_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Paket Harus Di isi'
                ]
            ],
            'deskripsi_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'harga_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Harga Paket Harus Di isi'
                ]
            ],
            'paket_foto_makeup' => [
                'rules' => 'uploaded[paket_foto_makeup]|max_size[paket_foto_makeup,10240]|is_image[paket_foto_makeup]|mime_in[paket_foto_makeup,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/paketMakeup')->withInput();
        }
//
//        var_dump('tes');
//        exit();

        $filetransaksi = $this->request->getFile('paket_foto_makeup');
        $namafile = $filetransaksi->getRandomName();
        $filetransaksi->move('assets/fotomakeup', $namafile);

        $this->PaketMakeup->save([
            'nama_paket_makeup'        => $this->request->getVar('nama_paket_makeup'),
            'deskripsi_paket_makeup'   => $this->request->getVar('deskripsi_paket_makeup'),
            'harga_paket_makeup'       => $this->request->getVar('harga_paket_makeup'),
            'foto_paket_makeup'       => $namafile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('Admin/paketMakeup')->withInput();
    }

    public function updatePaketMakeup($id)
    {
        if (!$this->validate([
            'nama_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Paket Harus Di isi'
                ]
            ],
            'deskripsi_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'harga_paket_makeup'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Harga Paket Harus Di isi'
                ]
            ],
            'paket_foto_makeup' => [
                'rules' => 'max_size[paket_foto_makeup,2048]|is_image[paket_foto_makeup]|mime_in[paket_foto_makeup,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/paketFotoMakeup')->withInput();
        }

        $filePoster = $this->request->getFile('paket_foto_makeup');
        if ($filePoster->getError() == 4) {
            $namaFile = $this->request->getVar('foto_lama');
        } else {
            $namaFile = $filePoster->getRandomName();
            $filePoster->move('assets/fotoMakeup', $namaFile);
            unlink('assets/fotoMakeup/' . $this->request->getVar('foto_lama'));
        }

        $this->PaketMakeup->update($id, [
            'nama_paket_makeup'        => $this->request->getVar('nama_paket_makeup'),
            'deskripsi_paket_makeup'   => $this->request->getVar('deskripsi_paket_makeup'),
            'harga_paket_makeup'       => $this->request->getVar('harga_paket_makeup'),
            'foto_paket_makeup'        => $namaFile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Update');
        return redirect()->to('Admin/paketMakeup')->withInput();
    }

    public function deletePaketMakeup($id)
    {
        $paket = $this->PaketMakeup->find($id);
        unlink('assets/fotoMakeup/' . $paket['foto_paket_makeup']);

        $this->PaketMakeup->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Delete');
        return redirect()->to('/Admin/paketMakeup');
    }


    public function paketFoto()
    {
        $data = [
            'title' => 'Paket Foto',
            'header'    => 'Paket Foto',
            'validasi'  => \Config\Services::validation(),
            'pakets'    => $this->Paket->getPaket()
        ];

        return view('Admin/paketfoto', $data);
    }

    public function insertPaket()
    {
        if (!$this->validate([
            'nama_paket'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Paket Harus Di isi'
                ]
            ],
            'deskripsi'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'harga_paket'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Harga Paket Harus Di isi'
                ]
            ],
            'paket_foto' => [
                'rules' => 'uploaded[paket_foto]|max_size[paket_foto,10240]|is_image[paket_foto]|mime_in[paket_foto,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/paketFoto')->withInput();
        }

        $filetransaksi = $this->request->getFile('paket_foto');
        $namafile = $filetransaksi->getRandomName();
        $filetransaksi->move('assets/foto', $namafile);

        $this->Paket->save([
            'Nama_Paket'        => $this->request->getVar('nama_paket'),
            'Deskripsi_Paket'   => $this->request->getVar('deskripsi'),
            'Harga_Paket'       => $this->request->getVar('harga_paket'),
            'Foto_Paket'       => $namafile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('Admin/paketFoto')->withInput();
    }

    public function updatePaket($id)
    {
        if (!$this->validate([
            'nama_paket'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Paket Harus Di isi'
                ]
            ],
            'deskripsi'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'harga_paket'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Harga Paket Harus Di isi'
                ]
            ],
            'paket_foto' => [
                'rules' => 'max_size[paket_foto,2048]|is_image[paket_foto]|mime_in[paket_foto,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/paketFoto')->withInput();
        }

        $filePoster = $this->request->getFile('paket_foto');
        if ($filePoster->getError() == 4) {
            $namaFile = $this->request->getVar('foto_lama');
        } else {
            $namaFile = $filePoster->getRandomName();
            $filePoster->move('assets/foto', $namaFile);
            unlink('assets/foto/' . $this->request->getVar('foto_lama'));
        }

        $this->Paket->save([
            'id_paket'          => $id,
            'Nama_Paket'        => $this->request->getVar('nama_paket'),
            'Deskripsi_Paket'   => $this->request->getVar('deskripsi'),
            'Harga_Paket'       => $this->request->getVar('harga_paket'),
            'Foto_Paket'        => $namaFile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Update');
        return redirect()->to('Admin/paketFoto')->withInput();
    }

    public function deletePaket($id)
    {
        $paket = $this->Paket->find($id);
        unlink('assets/foto/' . $paket['Foto_Paket']);

        $this->Paket->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Delete');
        return redirect()->to('/Admin/paketFoto');
    }

    public function rekening()
    {
        $data = [
            'title' => 'Rekening',
            'header'    => 'Rekening',
            'rekenings' => $this->Rekening->find(),
            'validasi'  => \Config\Services::validation()
        ];
        return view('Admin/rekening', $data);
    }

    public function insertRekening()
    {
        if (!$this->validate([
            'nama_rekening' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Rekening Harus Diisi'
                ]
            ],
            'atas_nama' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Atas Nama Harus Diisi'
                ]
            ],
            'no_rekening' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'No Rekening Harus Diisi'
                ]
            ]
        ])) {
            return redirect()->to('Admin/rekening')->withInput();
        };

        $this->Rekening->save([
            'nama_rekening'  => $this->request->getVar('nama_rekening'),
            'atas_nama' => $this->request->getVar('atas_nama'),
            'no_rekening'   => $this->request->getVar('no_rekening')
        ]);

        session()->setFlashdata('pesan', 'Rekening Berhasil ditambahkan');
        return redirect()->to('/Admin/rekening');
    }

    public function updateRekening($id)
    {
        if (!$this->validate([
            'nama_rekening' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Rekening Harus Diisi'
                ]
            ],
            'atas_nama' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Atas Nama Harus Diisi'
                ]
            ],
            'no_rekening' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'No Rekening Harus Diisi'
                ]
            ]
        ])) {
            return redirect()->to('Admin/rekening')->withInput();
        };

        $this->Rekening->save([
            'id'             => $id,
            'nama_rekening'  => $this->request->getVar('nama_rekening'),
            'atas_nama' => $this->request->getVar('atas_nama'),
            'no_rekening'   => $this->request->getVar('no_rekening')
        ]);

        session()->setFlashdata('pesan', 'Rekening Berhasil diupdate');
        return redirect()->to('/Admin/rekening');
    }

    public function deleteRekening($id)
    {

        $this->Rekening->delete($id);
        session()->setFlashdata('pesan', 'Rekening Berhasil di Delete');
        return redirect()->to('/Admin/rekening');
    }

    public function deleteTransaksi($id)
    {
        $this->Transaksi->where('Id_Reservasi', $id);
        $this->Transaksi->delete();

        $this->Reservasi->where('Id_Reservasi', $id);
        $this->Reservasi->delete();

        session()->setFlashdata('pesan', 'Transaksi Berhasil Dihapus');
        return redirect()->to('Admin/Index');
    }

    public function updateStatus($id)
    {
        $this->Reservasis->save([
            'id_reservasi'  => $id,
            'status_booking'        => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'status berhasil diupdate');
        return redirect()->to('/Admin/index');
    }

    public function transaksi()
    {
        $data = [
            'title' => 'Transaksi',
            'header'    => 'Transaksi',
            'datas' => $this->Transaksis->getDataTransaksi()
        ];
        return view('/Admin/transaksis', $data);
    }

    public function reservasi()
    {
        $data = [
            'title' => 'Reservasi',
            'header'    => 'Reservasi',
            'reservasi' => $this->Reservasis->getReservasi(),
            'validasi'  => \Config\Services::validation()
        ];

        return view('Admin/reservasis', $data);
    }

    public function pembayaran()
    {
        $data = [
            'title' => 'Pembayaran',
            'header'    => 'Pembayaran',
            'pembayaran' => $this->Pembayaran->getPembayaran(),
            'validasi'  => \Config\Services::validation()
        ];

        return view('Admin/pembayaran', $data);
    }

    public function ulasan()
    {
        $data = [
            'title' => 'Ulasan',
            'header'    => 'Ulasan',
            'ulasan' => $this->Ulasan->getUlasan(),
            'validasi'  => \Config\Services::validation()
        ];

        return view('Admin/ulasan', $data);
    }

    public function deleteUlasan($id)
    {
        $this->Ulasan->where('id_ulasan', $id);
        $this->Ulasan->delete();

        session()->setFlashdata('pesan', 'Ulasan Berhasil Dihapus');
        return redirect()->to('Admin/Index');
    }

    public function deleteReservasi($id)
    {
        $transaksi = $this->Transaksi->where('Id_Reservasi', $id)->first();
        if ($transaksi != null) {
            $this->Transaksi->delete($transaksi['Id_Transaksi']);
        }

        $this->Reservasi->delete($id);
        session()->setFlashdata('pesan', 'reservasi berhasil dihapus');
        return redirect()->to('/Admin/index');
    }

    public function galeri()
    {
        $data = [
            'title' => 'Gallery',
            'header'    => 'Gallery',
            'validasi'  => \Config\Services::validation(),
            'galeri'    => $this->Galeri->getGaleri()
        ];

        return view('Admin/galeri', $data);
    }

    public function insertGaleri()
    {

        if (!$this->validate([
            'nama_galeri'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Galeri Harus Di isi'
                ]
            ],
            'deskripsi'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'foto_galeri' => [
                'rules' => 'uploaded[foto_galeri]|max_size[foto_galeri,10240]|is_image[foto_galeri]|mime_in[foto_galeri,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/galeri')->withInput();
        }

        $filetransaksi = $this->request->getFile('foto_galeri');
        $namafile = $filetransaksi->getRandomName();
        $filetransaksi->move('assets/fotoGaleri', $namafile);

        $this->Galeri->save([
            'nama_galeri'        => $this->request->getVar('nama_galeri'),
            'deskripsi'   => $this->request->getVar('deskripsi'),
            'foto_galeri'       => $namafile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('Admin/galeri')->withInput();
    }

    public function updateGaleri($id)
    {
        if (!$this->validate([
            'nama_galeri'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Nama Galeri Harus Di isi'
                ]
            ],
            'deskripsi'    => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Deskripsi Harus Di isi'
                ]
            ],
            'foto_galeri' => [
                'rules' => 'max_size[foto_galeri,2048]|is_image[foto_galeri]|mime_in[foto_galeri,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded'  => 'Harap upload gambar',
                    'max_size' => 'ukuran gambar yang anda masukan terlalu besar',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('Admin/galeri')->withInput();
        }

        $filePoster = $this->request->getFile('foto_galeri');
        if ($filePoster->getError() == 4) {
            $namaFile = $this->request->getVar('foto_lama');
        } else {
            $namaFile = $filePoster->getRandomName();
            $filePoster->move('assets/fotoGaleri', $namaFile);
            unlink('assets/fotoGaleri/' . $this->request->getVar('foto_lama'));
        }

        $this->Galeri->update($id, [
            'nama_galeri'        => $this->request->getVar('nama_galeri'),
            'deskripsi'   => $this->request->getVar('deskripsi'),
            'foto_galeri'       => $namaFile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Update');
        return redirect()->to('Admin/galeri')->withInput();
    }

    public function deleteGaleri($id)
    {
        $paket = $this->Galeri->find($id);
        unlink('assets/fotoGaleri/' . $paket['foto_galeri']);

        $this->Galeri->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Delete');
        return redirect()->to('/Admin/galeri');
    }

    public function deleteTransaksis($id)
    {
        $paket = $this->Pembayaran->find($id);
        unlink('assets/bukti_transaksi/' . $paket['bukti_transaksi']);
        $this->Pembayaran->delete($id);

        $db = Database::connect();
        $builder1 = $db->table('reservasis');
        $builder1->where('id_pembayaran', $id);
        $builder1->delete();

        $builder2 = $db->table('transaksis');
        $builder2->where('id_pembayaran', $id);
        $builder2->delete();

        session()->setFlashdata('pesan', 'Data Berhasil di Delete');
        return redirect()->to('/Admin/transaksi');
    }

    public function map(){
        return view('Admin/map');

    }

    public function cetakTransaksis(){
        $dompdf = new Dompdf();
        $data = [
            'transaksi' => $this->Transaksis->getDataTransaksi()
        ];

        $file = "Laporan Transaksi" . date('d-m-Y');
        $view = view('Admin/printTransaksis', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($file);
    }

    public function cetakReservasis(){
        $dompdf = new Dompdf();
        $data = [
            'reservasis' => $this->Reservasis->getReservasi()
        ];

        $file = "Laporan Reservasi" . date('d-m-Y');
        $view = view('Admin/printReservasis', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($file);
    }

    public function cetakPembayaran(){
        $dompdf = new Dompdf();
        $data = [
            'pembayaran' => $this->Pembayaran->getPembayaran()
        ];

        $file = "Laporan Pembayaran" . date('d-m-Y');
        $view = view('Admin/printPembayaran', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($file);
    }

    public function cetakCostumer(){
        $dompdf = new Dompdf();
        $data = [
            'costumer' => $this->Customer->findAll()
        ];

        $file = "Laporan Costumer" . date('d-m-Y');
        $view = view('Admin/printCostumer', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($file);
    }
}
