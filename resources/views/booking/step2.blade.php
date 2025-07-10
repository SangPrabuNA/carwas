@extends('layouts.app')

@section('title', 'Booking - Step 2')

@section('content')
    {{-- Stepper Navigation --}}
    <div class="w-full max-w-2xl mx-auto mb-12">
        <div class="flex items-center">
            <div class="flex flex-col items-center text-center text-white"><div class="w-10 h-10 rounded-full flex items-center justify-center z-10 bg-blue-600 text-white font-bold">✓</div><p class="mt-2 text-sm font-semibold">Langkah 1</p><p class="text-xs opacity-80">Choose Service</p></div>
            <div class="flex-auto border-t-2 border-blue-600"></div>
            <div class="flex flex-col items-center text-center text-white"><div class="w-10 h-10 rounded-full flex items-center justify-center z-10 bg-blue-600 text-white font-bold">2</div><p class="mt-2 text-sm font-semibold">Langkah 2</p><p class="text-xs opacity-80">Set a Schedule</p></div>
            <div class="flex-auto border-t-2 border-gray-400"></div>
            <div class="flex flex-col items-center text-center text-white"><div class="w-10 h-10 rounded-full flex items-center justify-center z-10 bg-white text-gray-600 font-bold">3</div><p class="mt-2 text-sm font-semibold">Langkah 3</p><p class="text-xs opacity-80">Start Cleaning</p></div>
        </div>
    </div>

    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto" x-data="calendar('{{ $booking['tanggal_masuk'] ?? '' }}')">
        <form action="{{ route('booking.step2.store') }}" method="POST">
            @csrf
            
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Choose Date</h2>

            {{-- Hidden input untuk menyimpan tanggal yang dipilih --}}
            <input type="hidden" name="tanggal_masuk" x-model="selectedDate_formatted">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg text-gray-800">
                        <div class="flex justify-between items-center mb-4">
                            <button type="button" @click="prevMonth()" class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <h2 class="font-bold text-xl" x-text="`${months[month]} ${year}`"></h2>
                            <button type="button" @click="nextMonth()" class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-500 font-semibold mb-2">
                            <template x-for="day in daysOfWeek" :key="day"><div x-text="day"></div></template>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-center">
                            <template x-for="blank in blankDays"><div></div></template>
                            <template x-for="day in daysInMonth" :key="day">
                                <div @click="selectDate(day)"
                                     class="p-2 rounded-full cursor-pointer hover:bg-blue-100"
                                     :class="{
                                         'bg-blue-600 text-white font-bold': isSelected(day),
                                         'bg-gray-200 text-gray-400 cursor-not-allowed': isPast(day)
                                     }"
                                     x-text="day">
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($timeSlots as $time)
                            @php
                                $isBooked = in_array($time, $bookedTimes);
                            @endphp
                            <div class="relative">
                                <input type="radio" name="jam_masuk" id="time-{{ $time }}" value="{{ $time }}" 
                                       class="peer sr-only" required 
                                       {{ $isBooked ? 'disabled' : '' }}
                                       {{ (isset($booking['jam_masuk']) && $booking['jam_masuk'] == $time) ? 'checked' : '' }}>
                                <label for="time-{{ $time }}" 
                                       class="block p-3 border rounded-lg text-center transition-all 
                                              {{ $isBooked 
                                                  ? 'bg-gray-200 text-gray-400 cursor-not-allowed' 
                                                  : 'cursor-pointer peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600' }}">
                                    {{ $time }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between mt-10">
                <a href="{{ route('booking.step1.create') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg">Next</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    function calendar(initialDate) {
        return {
            month: new Date().getMonth(),
            year: new Date().getFullYear(),
            blankDays: [],
            daysInMonth: [],
            daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            selectedDate: null,
            selectedDate_formatted: initialDate || '',

            init() {
                if (this.selectedDate_formatted) {
                    // Adjust for timezone differences if date comes in YYYY-MM-DD format
                    const parts = this.selectedDate_formatted.split('-');
                    this.selectedDate = new Date(parts[0], parts[1] - 1, parts[2]);
                } else {
                    this.selectedDate = null; // Don't select any date by default
                }
                
                if (this.selectedDate) {
                    this.month = this.selectedDate.getMonth();
                    this.year = this.selectedDate.getFullYear();
                }

                this.getDays();
            },
            isSelected(day) {
                if (!this.selectedDate) return false;
                const d = new Date(this.year, this.month, day);
                return this.selectedDate.toDateString() === d.toDateString();
            },
            isPast(day) {
                const today = new Date();
                today.setHours(0,0,0,0);
                const d = new Date(this.year, this.month, day);
                return d < today;
            },
            selectDate(day) {
                if (this.isPast(day)) return;
                this.selectedDate = new Date(this.year, this.month, day);
                this.updateFormattedDate();
            },
            updateFormattedDate() {
                if (!this.selectedDate) {
                    this.selectedDate_formatted = '';
                    return;
                }
                const y = this.selectedDate.getFullYear();
                const m = (this.selectedDate.getMonth() + 1).toString().padStart(2, '0');
                const d = this.selectedDate.getDate().toString().padStart(2, '0');
                this.selectedDate_formatted = `${y}-${m}-${d}`;
            },
            getDays() {
                const days = new Date(this.year, this.month + 1, 0).getDate();
                const firstDay = new Date(this.year, this.month, 1).getDay();
                
                this.blankDays = Array.from({ length: firstDay });
                this.daysInMonth = Array.from({ length: days }, (_, i) => i + 1);
            },
            prevMonth() {
                this.month--;
                if (this.month < 0) {
                    this.month = 11;
                    this.year--;
                }
                this.getDays();
            },
            nextMonth() {
                this.month++;
                if (this.month > 11) {
                    this.month = 0;
                    this.year++;
                }
                this.getDays();
            }
        }
    }
</script>
@endpush