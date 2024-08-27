@extends('layouts.main')

@section('content')

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-2">Dashboard</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada dashboard ini, anda dapat melihat informasi terkait perumahan. Terdapat informasi mengenai jumlah saldo yang tersisa, jumlah rumah yang terdaftar, dan jumlah penghuni yang terdaftar. dan juga grafik pemasukan dan pengeluaran selama 1 tahun terakhir.
            </p>
        </div>


        <div class="grid grid-cols-3 gap-4">
            {{-- <h1 class="text-2xl font-bold mb-8">Dashboard</h1> --}}
            <x-bladewind::statistic
                number="Rp. {{$rukuntetangga->saldo}}"
                label="Saldo">

                <x-slot name="icon">
                    <svg class="h-16 w-16 p-2 text-white rounded-full bg-blue-500 shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M12.293 3.293a1 1 0 0 1 1.414 0L16.414 6h-2.828l-1.293-1.293a1 1 0 0 1 0-1.414ZM12.414 6 9.707 3.293a1 1 0 0 0-1.414 0L5.586 6h6.828ZM4.586 7l-.056.055A2 2 0 0 0 3 9v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.53-1.945L17.414 7H4.586Z" clip-rule="evenodd"/>
                      </svg>

                </x-slot>

            </x-bladewind::statistic>
            <x-bladewind::statistic
                number="{{$rumah->count()}}"
                label="Jumlah Rumah">

                <x-slot name="icon">
                    <svg class="h-16 w-16 p-2 text-white rounded-full bg-green-500 shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"fill="currentColor" viewBox="0 0 64 64">
                        <path d="M 32 3 L 1 28 L 1.4921875 28.654297 C 2.8591875 30.477297 5.4694688 30.791703 7.2304688 29.345703 L 32 9 L 56.769531 29.345703 C 58.530531 30.791703 61.140812 30.477297 62.507812 28.654297 L 63 28 L 54 20.742188 L 54 8 L 45 8 L 45 13.484375 L 32 3 z M 32 13 L 8 32 L 8 56 L 56 56 L 56 35 L 32 13 z M 26 34 L 38 34 L 38 52 L 26 52 L 26 34 z"></path>
                      </svg>

                </x-slot>

            </x-bladewind::statistic>
            <x-bladewind::statistic
                number="{{$penghuni->count()}}"
                label="Jumlah Penghuni">

                <x-slot name="icon">
                    <svg class="h-16 w-16 p-2 text-white rounded-full bg-rose-500 shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                      </svg>

                </x-slot>

            </x-bladewind::statistic>

        </div>
        <div id="container" class="py-5" style="width:100%; height:400px;"></div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        let pemasukan = @json($pembayaran);
        let pengeluaran = @json($pengeluaran);

        function aggregateMonthlyData(data, amountKey) {
            return data.reduce((acc, item) => {
                let date = new Date(item.tanggal);
                let month = date.getMonth();
                if (!acc[month]) {
                    acc[month] = 0;
                }
                acc[month] += Number(item[amountKey]);
                return acc;
            }, new Array(12).fill(0));
        }

        let dataPemasukan = aggregateMonthlyData(pemasukan, 'jumlah');
        let dataPengeluaran = aggregateMonthlyData(pengeluaran, 'nominal');


        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Pemasukan dan Pengeluaran selama 1 Tahun'
            },
            subtitle: {
                text: 'Perumahan Indah Permai Lumajang'
            },
            xAxis: {
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                ]
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Pemasukan',
                data: dataPemasukan,
            }, {
                name: 'Pengeluaran',
                data: dataPengeluaran,
            }]
        });


    </script>
@endsection

