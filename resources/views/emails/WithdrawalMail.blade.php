@php
    use Carbon\Carbon;
@endphp
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
                                    <img width="20%"
                                        src="https://i.ibb.co/YRYMs70/d-Hwk0o-Wqh-Hic9-UVn5zuh7-TXWB7-Ztbt-M7j0zbqb1p.png"
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
                                                        Penarikan Dana</h1>
                                                    <p style="font-weight: 500;">Haii.. Admin ada yang menarik dana
                                                        nih
                                                    </p>
                                                    <p style="font-weight: 500;">Detail data penarikan sebagai berikut :
                                                    </p>
                                                    <table style="width: 100%; background-color:#edf2f7; padding:5%;">
                                                        <tr>
                                                            <td style="font-weight:500;">Nama :</td>
                                                            <td style="font-weight:500;">{{ $data['user']->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:500;">Tanggal penarikan:</td>
                                                            <td style="font-weight:500;">
                                                                {{ Carbon::parse($data['time'])->isoFormat('dddd, D MMMM Y') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:500;">Penarikan Via:</td>
                                                            <td style="font-weight:500;">{{ $data['via'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:500;">Saldo Penarikan</td>
                                                            <td style="color:#0000FF; font-weight:500;">Rp.
                                                                {{ number_format($data['balance'], 0, ',', '.') }}
                                                            </td>
                                                        </tr>
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
