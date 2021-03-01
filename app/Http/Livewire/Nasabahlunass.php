<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NasabahLunas;

class Nasabahlunass extends Component
{
  public $nasabahlunass, $nama, $nohp, $alamat, $norekening, $pinjaman, $jangkawaktu, $status, $nasabahlunas_id;
  public $isModal = 0;

  public function render() //FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
  {
    $this->nasabahlunass = NasabahLunas::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA
    return view('livewire.nasabahlunass'); //LOAD VIEW INDEX.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURCES/VIEWS/NASABAH
  }

  public function create() //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH NASABAHLUNAS DITEKAN
  {
    $this->resetFields(); //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
    $this->openModal(); //DAN MEMBUKA MODAL
  }

  public function closeModal() //FUNGSI INI UNTUK MENUTUP MODAL DIMANA VARIABLE ISMODAL KITA SET JADI FALSE
  {
    $this->isModal = false;
  }

  public function openModal() //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA MODAL
  {
    $this->isModal = true;
  }

  public function resetFields()   //FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI
  {
    $this->nama = '';
    $this->nohp = '';
    $this->alamat = '';
    $this->norekening = '';
    $this->pinjaman = '';
    $this->jangkawaktu = '';
    $this->status = '';
    $this->nasabahlunas_id = '';
  }

  public function store()  //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
  {
    //MEMBUAT VALIDASI
    $this->validate([
      'nama' => 'required|string',
      'nohp' => 'required|numeric',
      'alamat' => 'required|string',
      'norekening' => 'required|string',
      'pinjaman' => 'required|string',
      'jangkawaktu' => 'required|string',
      'status' => 'required'
    ]);

    //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
    //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
    //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
    NasabahLunas::updateOrCreate(['id' => $this->nasabahlunas_id], [
      'nama' => $this->nama,
      'nohp' => $this->nohp,
      'alamat' => $this->alamat,
      'norekening' => $this->norekening,
      'pinjaman' => $this->pinjaman,
      'jangkawaktu' => $this->jangkawaktu,
      'status' => $this->status,
    ]);

    //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
    session()->flash('message', $this->nasabahlunas_id ? $this->nama . ' Diperbaharui' : $this->nama . ' Ditambahkan');
    $this->closeModal(); //TUTUP MODAL
    $this->resetFields(); //DAN BERSIHKAN FIELD
  }

  //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
  public function edit($id)
  {
    $nasabahlunass = NasabahLunas::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
    //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
    $this->nasabahlunas_id = $id;
    $this->nama = $nasabahlunass->nama;
    $this->nohp = $nasabahlunass->nohp;
    $this->alamat = $nasabahlunass->alamat;
    $this->norekening = $nasabahlunass->norekening;
    $this->pinjaman = $nasabahlunass->pinjaman;
    $this->jangkawaktu = $nasabahlunass->jangkawaktu;
    $this->status = $nasabahlunass->status;

    $this->openModal(); //LALU BUKA MODAL
  }

  //FUNGSI INI UNTUK MENGHAPUS DATA
  public function delete($id)
  {
    $nasabahlunass = NasabahLunas::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
    $nasabahlunass->delete(); //LALU HAPUS DATA
    session()->flash('message', $nasabahlunass->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
  }
}
