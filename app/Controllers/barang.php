<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\barangModel;

class Barang extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new barangModel();
        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => ''
            ],
            'barang' => [
                'title' => 'barang',
                'link' => base_url() . '/barang',
                'icon' => 'fa-brands fa-shopify',
                'aktif' => 'active'
            ],
            'item_barang' => [
                'title' => 'item barang',
                'link' => base_url() . '/item_barang',
                'icon' => 'fa-solid fa-cart-shopping',
                'aktif' => ''
            ],
            'karyawan' => [
                'title' => 'Karyawan',
                'link' => base_url() . '/karyawan',
                'icon' => 'fa-solid fa-user-large',
                'aktif' => ''
            ],
        ];
        $this->rules = [
            'jenis_barang' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'jenis_barang tidak boleh kosong.',
                ]
            ],
            'nama_barang' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'nama barang tidak boleh kosong.',
                ]
            ],
            'kode_barang' =>[
                'rules'=>'required',
                'errors'=>[
                    'required' => 'kode barang tidak boleh kosong.',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
     <h1 class="m-0">Barang</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">barang</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Data barang';

        $query = $this->pm->find();
        $data['data_barang'] =$query;
        return view('barang/content', $data);
    }

    public function tambah() 
    {
        $breadcrumb = '<div class="col-sm-6">
        <h1 class="m-0">barang</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="'.base_url(). '">Beranda</a></li>
             <li class="breadcrumb-item"><a href="'.base_url().'">barang</a></li>
             <li class="breadcrumb-item active">Tambah barang</li>
           </ol>
         </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Tambah barang';
        $data['action'] = base_url() . '/barang/simpan';
        return view('barang/input', $data);
    }
    public function simpan()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
           
            return redirect()->back()->withinput();
        }
        if (! $this->validate($this->rules)) {
          return redirect()->back()->withinput();
        }

        
        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);
            return redirect()->to('barang')->with('success','Data berhasil disimpan');
        } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withinput();
        }
    }

    public function hapus($id) 
    {
        if(empty($id)){
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }
        try {
            $this->pm->delete($id);
            return redirect()->to('barang')->with('success', 'Data barang' . 'berhasil dihapus');
        } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
            return redirect()-to('barang')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">barang</h1>
                        </div>
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="'.base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="'.base_url().'/barang">barang</a></li>
                            <li class="breadcrumb-item active">Edit barang</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Edit Barang';
        $data['action'] = base_url() . '/barang/update';

        $data['edit_data'] =$this->pm->find($id);
        return view('barang/input', $data);
    }
    public function update(){
       $dtEdit = $this->request->getPost();
       $param = $dtEdit['param'];
       unset($dtEdit['param']);
      try {
        $this->pm->update($param, $dtEdit);
        return redirect()->to('barang')->with('success', 'Data berhasil di update');
      } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
        session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withinput();
      }
    }
}
