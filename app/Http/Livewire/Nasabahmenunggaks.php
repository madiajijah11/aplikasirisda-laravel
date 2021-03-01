<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NasabahMenunggak;

class Nasabahmenunggaks extends Component
{
  public $nasabahmenunggaks, $nama, $nohp, $alamat, $norekening, $pinjaman, $tgljatuhtempo, $jumlahmenunggak, $nasabahmenunggak_id;
  public $isModal = 0;

  public function render()
  {
    $this->nasabahmenunggaks = NasabahMenunggak::orderBy('created_at', 'DESC')->get();
    return view('livewire.nasabahmenunggaks');
  }

  public function create() {
    $this->resetFields();
    $this->openModal();
  }

  public function closeModal() {
    $this->isModal = false;
  }

  public function openModal() {
    $this->isModal = true;
  }

  public function resetFields() {
    $this->nama = '';
    $this->nohp = '';
    $this->alamat = '';
    $this->norekening = '';
    $this->pinjaman = '';
    $this->tgljatuhtempo = '';
    $this->jumlahmenunggak = '';
    $this->nasabahmenunggak_id = '';
  }

  public function store() {
    $this->validate([
      'nama' => 'required|string',
      'nohp' => 'required|numeric',
      'alamat' => 'required|string',
      'norekening' => 'required|string',
      'pinjaman' => 'required|string',
      'tgljatuhtempo' => 'required|date',
      'jumlahmenunggak' => 'required'
    ]);

    NasabahMenunggak::updateOrCreate(['id' => $this->nasabahmenunggak_id], [
      'nama' => $this->nama,
      'nohp' => $this->nohp,
      'alamat' => $this->alamat,
      'norekening' => $this->norekening,
      'pinjaman' => $this->pinjaman,
      'tgljatuhtempo' => $this->tgljatuhtempo,
      'jumlahmenunggak' => $this->jumlahmenunggak,
    ]);

    session()->flash('message', $this->nasabahmenunggak_id ? $this->nama . 'Diperbaharui' : $this->nama . 'Ditambahkan');
    $this->closeModal();
    $this->resetFields();
  }

  public function edit($id) {
    $nasabahmenunggaks = NasabahMenunggak::find($id);
    $this->nasabahmenunggak_id = $id;
    $this->nama = $nasabahmenunggaks->nama;
    $this->nohp = $nasabahmenunggaks->nohp;
    $this->alamat = $nasabahmenunggaks->alamat;
    $this->norekening = $nasabahmenunggaks->norekening;
    $this->pinjaman = $nasabahmenunggaks->pinjaman;
    $this->tgljatuhtempo = $nasabahmenunggaks->tgljatuhtempo;
    $this->jumlahmenunggak = $nasabahmenunggaks->jumlahmenunggak;

    $this->openModal();
  }

  public function delete($id) {
    $nasabahmenunggaks = NasabahMenunggak::find($id);
    $nasabahmenunggaks->delete();
    session()->flash('message', $nasabahmenunggaks->nama . 'Dihapus');
  }

}
