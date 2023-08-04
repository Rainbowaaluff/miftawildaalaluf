<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
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
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Selamat Datang di My Website";
        $data['selamat_datang'] = "Semoga Memenuhi Kebutuhan Anda";
        return view('template/content', $data);
    }
}
