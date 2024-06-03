@extends('layouts.main')
@section('content')
{{-- <div class="container">

    <div class="card">
        <div class="card-header">
            <img src="{{ asset('images/YellowKodelisensi.png') }}" alt="" class="w-100">
        </div>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="">
                    <h2 class="fw-bold text-primary">Terima Kasih</h2>
                </div>
                <div class=""><span class="">No. Invoice</span></div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class=""><span class="fw-bold ">Pembelian anda telah berhasil,di bawah ini adalah detail
                        pembelian Anda:</span></div>
                <div class=""><span class="fw-bold">KLHM0540</span></div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        <div class="form-group"><label for="" class="form-label">Nama Produk</label>
                            <p class="fw-bold">Microsoft Windows 10 Professional</p>
                        </div>
                    </td>
                    <td class="d-none"></td>
                    <td colspan="1">
                        <div class="form-group"><label for="" class="form-label">Harga</label>
                            <p class="fw-bold">Rp. 215.000</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group"><label for="" class="form-label">Serial Number</label>
                            <p class="fw-bold">ABCD-DEFG-HIJK</p>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="card mt-2 p-5">
                <p class="fw-bold text-warning">Download Windows 10</p>
                <p>Jika belum memiliki windows 10,bisa langsung download di situr resminya,yaitu: https://www.facebook.com
                </p>
            </div>
            <div class="card mt-2 p-5 mb-2">
                <p class="fw-bold text-danger">PERHATIAN !!</p>
                <p>Jika belum memiliki windows 10,bisa langsung download di situr resminya,yaitu: https://www.facebook.com
                </p>
                <p>Jika mengalami kesulitan/masalah ketika aktivasi,silahkan hubungi CS kami di No.WA: </p>
            </div>

        </div>
    </div>
</div> --}}
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #f8f9fa; padding: 10px;">
            <img src="{{ asset('images/YellowKodelisensi.png') }}" alt="" style="width: 100%;">
        </div>
        <div style="padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <div style="">
                    <h2 style="font-weight: bold; color: #007bff;">Terima Kasih</h2>
                </div>
                <div style=""><span style="">No. Invoice</span></div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <div style=""><span style="font-weight: bold;">Pembelian anda telah berhasil,di bawah ini adalah detail pembelian Anda:</span></div>
                <div style=""><span style="font-weight: bold;">KLHM0540</span></div>
            </div>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;" colspan="2">
                        <div style=""><span style="font-weight: bold;">Nama Produk</span></div>
                        <p style="font-weight: bold;">Microsoft Windows 10 Professional</p>
                    </td>
                    <td class="d-none"></td>
                    <td style="border: 1px solid #ddd; padding: 10px;" colspan="1">
                        <div style=""><span style="font-weight: bold;">Harga</span></div>
                        <p style="font-weight: bold;">Rp. 215.000</p>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;" colspan="3">
                        <div style=""><span style="font-weight: bold;">Serial Number</span></div>
                        <p style="font-weight: bold;">ABCD-DEFG-HIJK</p>
                    </td>
                </tr>
            </table>
            <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-top: 20px;">
                <p style="font-weight: bold; color: #ffc107;">Download Windows 10</p>
                <p>Jika belum memiliki windows 10, bisa langsung download di situs resminya, yaitu: <a href="https://www.facebook.com" style="color: #000; text-decoration: none;">https://www.facebook.com</a></p>
            </div>
            <div style="background-color: #fff; border: 1px solid #dc3545; border-radius: 8px; padding: 20px; margin-top: 20px;">
                <p style="font-weight: bold; color: #dc3545;">PERHATIAN !!</p>
                <p>Jika belum memiliki windows 10, bisa langsung download di situs resminya, yaitu: <a href="https://www.facebook.com" style="color: #000; text-decoration: none;">https://www.facebook.com</a></p>
                <p>Jika mengalami kesulitan/masalah ketika aktivasi, silahkan hubungi CS kami di No.WA: </p>
            </div>
        </div>
    </div>
</div>


    @endsection
