@extends('layouts.master')
@section('css')
@endsection

@section('content')
<div class="card my-5  " id="schedule">
    <div class="card-body h-100">
        <div class="breadcrumb-header d-flex justify-content-between align-items-end ">
            <div >
                <h4 class="tx-15 text-uppercase mr-4 text-info">Schedule</h4>
            </div>
            <div class="btn-group ">
                <a class="btn btn-outline-info @if( url('/doctor/schedule') == URL::full() ) {{ 'active' }} @endif " href="{{ url('/doctor/schedule') }}" >this Week</a>
                <a class="btn btn-outline-info @if( url('/doctor/schedule/1') == URL::full() ) {{ 'active' }} @endif" href='{{ url('/doctor/schedule/1') }}' >Next Week</a>
                <a class="btn btn-outline-info @if( url('/doctor/schedule/2') == URL::full() ) {{ 'active' }} @endif" href='{{ url('/doctor/schedule/2') }}' >Next >> </a>
            </div>
        </div>
        <div class="m-t-30">		
            <hr>
        </div>
        <table class="table  table-bordered 	 mg-b-0 text-md-nowrap mt-4">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">9:00 am</th>
                    <th class="text-center">10:00 am</th>
                    <th class="text-center">11:00 am</th>
                    <th class="text-center">12:00 am</th>
                    <th class="text-center">13:00 pm</th>
                    <th class="text-center">14:00 pm</th>
                    <th class="text-center">15:00 pm</th>
                    <th class="text-center">16:00 pm</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        Monday
                    </th>
                    @for ($i = 9; $i < 17; $i++ )
                        <th class="text-center p-3"> 
                            @for ( $j = 0; $j < count($appointment['Mon']) ; $j++ )
                                @if( $appointment['Mon'][$j]->time == $i.':00:00')
                                
                                    {{ $appointment['Mon'][$j]->patient->fullname  }}
                                
                                @else
                                    
                                @endif
                            @endfor
                        </th>
                    @endfor
                </tr>
                <tr>
                    <th>
                        Tuesday
                    </th>
                    @for ($i = 9; $i < 17; $i++ )
                        <th class="text-center p-3"> 
                            @for ( $j = 0; $j < count($appointment['Tue']) ; $j++ )
                                @if( $appointment['Tue'][$j]->time == $i.':00:00')
                                
                                    {{ $appointment['Tue'][$j]->patient->fullname  }}
                                
                                @else
                                
                                @endif
                            @endfor
                        </th>
                    @endfor
                </tr><tr>
                    <th>
                        Wednesday
                    </th>
                    @for ($i = 9; $i < 17; $i++ )
                        <th class="text-center p-3"> 
                            @for ( $j = 0; $j < count($appointment['Wed']) ; $j++ )
                                @if( $appointment['Wed'][$j]->time == $i.':00:00')
                                
                                    {{ $appointment['Wed'][$j]->patient->fullname  }}
                                
                                @else
                                
                                @endif
                            @endfor
                        </th>
                    @endfor
                </tr>
                <tr>
                    <th>
                        Thursday
                    </th>
                        @for ($i = 9; $i < 17; $i++ )
                        <th class="text-center p-3"> 
                            @for ( $j = 0; $j < count($appointment['Thu']) ; $j++ )
                                @if( $appointment['Thu'][$j]->time == $i.':00:00')
                                
                                    {{ $appointment['Thu'][$j]->patient->fullname }}
                                
                                @else
                                
                                @endif
                            @endfor
                        </th>
                        @endfor
                </tr>
                <tr>
                    <th>
                        Friday
                    </th>
                    @for ($i = 9; $i < 17; $i++ )
                        <th class="text-center p-3"> 
                            @for ( $j = 0; $j < count($appointment['Fri']) ; $j++ )
                                @if( $appointment['Fri'][$j]->time == $i.':00:00')
                                
                                    {{ $appointment['Fri'][$j]->patient->fullname  }}
                                
                                @else
                                
                                @endif
                            @endfor
                        </th>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')

@endsection