<div
    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;margin:0;padding:0;width:100%">
        <tbody>
            <tr>
                <td align="center"
                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:0;padding:0;width:100%">
                        <tbody>
                            <tr>
                                <td
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding:25px 0;text-align:center">
                                    <img width="20%" src="{{ config('app.url') . 'storage/' . $site->logo }}"
                                        alt="Logo">
                                </td>
                            </tr>


                            <tr>
                                <td width="100%" cellpadding="0" cellspacing="0"
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                                    <table class="m_-1691184708288144981inner-body" align="center" width="570"
                                        cellpadding="0" cellspacing="0" role="presentation"
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px">

                                        <tbody>
                                            <tr>
                                                <td
                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
                                                    {{-- <h1
                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                                        Halo {{ $user->name }}</h1> --}}
                                                    <h1 style="text-align: center;">
                                                        Konfirmasi Edit Rekening</h1>
                                                    <p style="font-weight: 500;">Haii..Kami baru saja melihat akun Anda
                                                        untuk mengedit rekening
                                                        akun
                                                        anda.Kami ingin memastikan bahwa itu memang Anda.

                                                    </p>
                                                    {{-- <div style="width: 100%; background-color:#edf2f7; padding:5%;">
                                                        <p style="font-weight: 500;">Nama pemilik:
                                                            {{ $data['name'] }}</p>
                                                        <p style="font-weight: 500;">Nama bank:
                                                            {{ $data['rekening'] }}</p>
                                                        <p style="font-weight: 500;">Nomor rekening:
                                                            {{ $data['rekening_number'] }}</p>
                                                    </div> --}}

                                                    <table style="width: 100%; background-color:#edf2f7; padding:5%;">
                                                        <tr>
                                                            <td style="font-weight:500;">Nama Pemilik :</td>
                                                            <td style="font-weight:500;">{{ $data['name'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:500;">Bank:</td>
                                                            <td style="font-weight:500;">{{ $data['rekening'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:500;">Nomor Rekening:</td>
                                                            <td style="font-weight:500;">{{ $data['rekening_number'] }}
                                                            </td>
                                                        </tr>
                                                    </table>


                                                    <p style="font-weight: 500;">Apakah Anda meminta edit rekening ?
                                                        jika
                                                        tidak abaikan Pesan
                                                        ini
                                                    </p>
                                                    <p style="font-weight: 500;">Klik tombol berikut untuk mengedit
                                                        rekening
                                                        Anda :</p>
                                                    <table align="center" width="100%" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:30px auto;padding:0;text-align:center;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center"
                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                    <table border="0"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        role="presentation"
                                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                                    <a href="{{ route('dashboard.balance.withdrawal.rekening-numbers.index', ['rekening_number' => $data['id']]) }}"
                                                                                                        class="m_-1691184708288144981 button"
                                                                                                        rel="noopener"
                                                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748"
                                                                                                        target="_blank">Konfirmasi</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style="font-weight: 500;">Terima kasih,</p>
                                                    <p style="font-weight: 500;">Tim Kodelisensi</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
