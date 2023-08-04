<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\karyawanModel;

class karyawan extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new karyawanModel();
        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active'
            ],
            'barang' => [
                'title' => 'barang',
                'link' => base_url() . '/barang',
                'icon' => 'fa-brands fa-shopify',
                'aktif' => ''
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
            'karyawan' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'karyawan tidak boleh kosong.',
                ]
            ],
            'nama' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'nama tidak boleh kosong.',
                ]
            ],
            'kode_karyawan' =>[
                'rules'=>'required',
                'errors'=>[
                    'required' => 'kode karyawan tidak boleh kosong.',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
     <h1 class="m-0">karyawan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">karyawan</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='karyawan';

        $query = $this->pm->find();
        $data['data_karyawan'] =$query;
        return view('karyawan/content', $data);
    }

    public function tambah() 
    {
        $breadcrumb = '<div class="col-sm-6">
        <h1 class="m-0">barang</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="'.base_url() . '">Beranda</a></li>
             <li class="breadcrumb-item"><a href="'.base_url().'/karyawan">karyawan</a></li>
             <li class="breadcrumb-item active">Tambah karyawan</li>
           </ol>
         </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Tambah karyawan';
        $data['action'] = base_url() . '/karyawan/simpan';
        return view('karyawan/input', $data);
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
            return redirect()->to('karyawan')->with('success','Data berhasil disimpan');
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
            return redirect()->to('karyawan')->with('success', 'Data karyawan' . 'berhasil dihapus');
        } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
            return redirect()-to('karyawan')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="'.base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="'.base_url().'/karyawan">karyawan</a></li>
                            <li class="breadcrumb-item active">Edit karyawan</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Edit karyawan';
        $data['action'] = base_url() . '/karyawan/update';

        $data['edit_data'] =$this->pm->find($id);
        return view('karyawan/input', $data);
    }
    public function update(){
       $dtEdit = $this->request->getPost();
       $param = $dtEdit['param'];
       unset($dtEdit['param']);
       unset($this->rules['password']);
       if (! $this->validate($this->rules)) {

        return redirect()->back()->withinput();
      }
      if (empty($dtEdit['password'])){
        unset($dtEdit['password']);
      }
      try {
        $this->pm->update($param, $dtEdit);
        return redirect()->to('karyawan')->with('success', 'Data berhasil di update');
      } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
        session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withinput();
      }
    }
}
