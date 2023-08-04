<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\item_barangmodel;

class item_barang extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new item_barangModel();
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
            'jumlah_barang' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'jumlah barang tidak boleh kosong.',
                ]
            ],
            'sisa_barang' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'jumlah barang tidak boleh kosong.',
                ]
            ],
            'tambahan' =>[
                'rules'=>'required',
                'errors'=>[
                    'required' => 'tambahan  tidak boleh kosong.',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
     <h1 class="m-0">item_barang</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">item barang</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Data item barang';

        $query = $this->pm->find();
        $data['data_item_barang'] =$query;
        return view('item_barang/content', $data);
    }

    public function tambah() 
    {
        $breadcrumb = '<div class="col-sm-6">
        <h1 class="m-0">item barang</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="'.base_url() . '">Beranda</a></li>
             <li class="breadcrumb-item"><a href="'.base_url().'/item_barang">item barang</a></li>
             <li class="breadcrumb-item active">Tambah item barang</li>
           </ol>
         </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='item_barang';
        $data['action'] = base_url() . '/item_barang/simpan';
        return view('item_barang/input', $data);
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
            return redirect()->to('item barang')->with('success','Data berhasil disimpan');
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
            return redirect()->to('item_barang')->with('success', 'Data item barang dengan kode' .$id. 'berhasil dihapus');
        } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
            return redirect()-to('item_barang')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">item_barang</h1>
                        </div>
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="'.base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="'.base_url().'/item_barang">item_barang</a></li>
                            <li class="breadcrumb-item active">Edit item barang</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] ='Edit item barang';
        $data['action'] = base_url() . '/item_barang/update';

        $data['edit_data'] =$this->pm->find($id);
        return view('item barang/input', $data);
    }
    public function update(){
       $dtEdit = $this->request->getPost();
       $param = $dtEdit['param'];
       unset($dtEdit['param']);
      try {
        $this->pm->update($param, $dtEdit);
        return redirect()->to('item_barang')->with('success', 'Data berhasil di update');
      } catch (\Codeigniter\Database\Exceptions\DatabaseException $e) {
        session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withinput();
      }
    }
}
