@php use Carbon\Carbon; @endphp
<div>
    <div class="overflow-x-auto">
        <table
            class="border-collapse border-wishka-400 w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded table-auto">
            <thead
                class=" text-md text-uppercase text-gray-700 uppercase dark:bg-dark dark:text-white text-bold text-center">
            <tr class="border-b-[3px] border-wishka-400 border-collapse text-xs">
                <td class="py-2 px-2" rowspan="2">Tanggal</td>
                <td class="py-2 px-2" rowspan="2">NAMA</td>
                <td class="py-2 px-2" rowspan="2">Bagian</td>
                <td class="py-2 px-2" colspan="2">Berangkat</td>
                <td class="py-2 px-2" colspan="2">Pulang</td>
{{--                <td class="py-2 px-2" rowspan="2">Tindakan</td>--}}
            </tr>
            <tr class="border-b-[3px] border-wishka-400 border-collapse text-xs">
                <td>Status</td>
                <td>Jam</td>
                <td>Status</td>
                <td>Jam</td>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Attendance::where('user_id',$userId)->get() as $attendance)
                <tr class="border-b-2 border-wishka-400 border-collapse text-center">
                    <td>
                        {{ $attendance->master->attendance_date }}
                    </td>
                    <td>
                        {{ $attendance->user->name }}
                    </td>
                    <td>
                        {{ $attendance->user->position }}
                    </td>
                    <td>
                        @if($attendance->entrance_attendance_by_web)
                            @if(Carbon::parse(($attendance->entrance_attendance_by_web))->format('H:i')>(\App\Models\GeneralInfo::where('key','=','jam_masuk')->first()->value??'08:00'))
                                Terlambat
                            @else
                                Tepat waktu
                            @endif
                        @endif
                    </td>
                    <td>{{ $attendance->entrance_attendance_by_web?Carbon::parse(($attendance->entrance_attendance_by_web))->format('H:i'):'' }}</td>
                    <td>
                        @if($attendance->discharge_attendance_by_web)
                            @if(Carbon::parse(($attendance->entrance_attendance_by_web))->format('H:i')<(\App\Models\GeneralInfo::where('key','=','jam_pulang')->first()->value??'17:00'))
                                Pulang Awal
                            @else
                                Tepat waktu
                            @endif
                        @endif
                    </td>
                    <td>{{ $attendance->discharge_attendance_by_web?Carbon::parse(($attendance->discharge_attendance_by_web))->format('H:i'):'' }}</td>
                    <td>
{{--                        <div class='text-xl flex gap-1 justify-center'>--}}
{{--                            <a href='{{ route('attendance.edit-attendance',[$attendanceId,$attendance->id]) }}'--}}
{{--                               class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-pencil'></i></a>--}}
{{--                            <a href='{{ route('attendance.user-attendance',[$attendance->user_id]) }}'--}}
{{--                               class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-eye'></i></a>--}}
{{--                            --}}{{--                            <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>--}}
{{--                        </div>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
