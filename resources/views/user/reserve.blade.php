@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10" x-data="calendarComponent()">
    {{-- Progress Bar --}}
    <template x-if="step === 1">
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Select Reservation Date</h2>
            <div class="w-full bg-gray-200 h-1.5 rounded-full">
                <div class="h-1.5 bg-blue-600 rounded-full" style="width: 20%"></div>
            </div>
        </div>
    </template>

    {{-- STEP 1: Select Reservation Date --}}
    <div x-show="step === 1" x-transition>
        <h1 class="text-3xl font-bold text-center mb-6">Select Reservation Date</h1>

        {{-- Calendar --}}
        <div class="flex flex-col md:flex-row justify-center gap-10">
            {{-- Left (current) month --}}
            <div class="w-full md:w-1/2">
                <div class="flex justify-between items-center mb-3">
                    <button @click="prevMonth" class="text-gray-600 hover:text-blue-600 text-2xl">&lt;</button>
                    <h3 class="text-lg font-semibold" x-text="monthNames[currentMonth] + ' ' + currentYear"></h3>
                    <div></div>
                </div>

                <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-500 mb-1">
                    <template x-for="(d, i) in daysShort" :key="i">
                        <div x-text="d" class="uppercase"></div>
                    </template>
                </div>

                <div class="grid grid-cols-7 gap-2 text-center">
                    <template x-for="cell in daysArray(0)" :key="cell._key">
                        <div class="p-2">
                            <button
                                x-text="cell.day || ''"
                                @click="cell.date && !isPastDate(cell.date) && selectDate(cell.date)"
                                class="w-8 h-8 rounded-full transition"
                                :class="{
                                    'bg-blue-600 text-white font-semibold': isSameDate(cell.date, selectedDate),
                                    'text-gray-700 hover:bg-blue-50 cursor-pointer': cell.date && !isSameDate(cell.date, selectedDate),
                                    'opacity-30': !cell.date || isPastDate(cell.date)
                                }"
                            ></button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Right (next) month --}}
            <div class="w-full md:w-1/2">
                <div class="flex justify-between items-center mb-3">
                    <div></div>
                    <h3 class="text-lg font-semibold" x-text="monthNames[nextMonthIndex] + ' ' + nextYear"></h3>
                    <button @click="nextMonthClick" class="text-gray-600 hover:text-blue-600 text-2xl">&gt;</button>
                </div>

                <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-500 mb-1">
                    <template x-for="(d, i) in daysShort" :key="i">
                        <div x-text="d" class="uppercase"></div>
                    </template>
                </div>

                <div class="grid grid-cols-7 gap-2 text-center">
                    <template x-for="cell in daysArray(1)" :key="cell._key">
                        <div class="p-2">
                            <button
                                x-text="cell.day || ''"
                                @click="cell.date && !isPastDate(cell.date) && selectDate(cell.date)"
                                class="w-8 h-8 rounded-full transition"
                                :class="{
                                    'bg-blue-600 text-white font-semibold': isSameDate(cell.date, selectedDate),
                                    'text-gray-700 hover:bg-blue-50 cursor-pointer': cell.date && !isSameDate(cell.date, selectedDate),
                                    'opacity-30': !cell.date || isPastDate(cell.date)
                                }"
                            ></button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Time Selection --}}
        <div class="mt-10 space-y-6">
            {{-- Start Time --}}
            <div>
                <h3 class="font-semibold mb-3">Start Time</h3>
                <div class="flex flex-wrap gap-3">
                    <template x-for="time in timeSlots" :key="time">
                        <button
                            @click="selectStartTime(time)"
                            x-text="time"
                            :disabled="!selectedDate || unavailableTimes.includes(time)"
                            class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 transition"
                            :class="{
                                'bg-blue-600 text-white border-blue-600': selectedStart === time,
                                'opacity-40 cursor-not-allowed': !selectedDate || unavailableTimes.includes(time) || (isSameDate(selectedDate, today) && isPastTime(time)),
                                'hover:bg-blue-100': selectedDate && !unavailableTimes.includes(time) && !(isSameDate(selectedDate, today) && isPastTime(time))
                            }"
                        ></button>
                    </template>
                </div>
            </div>

            {{-- End Time --}}
            <div>
                <h3 class="font-semibold mb-3">End Time</h3>
                <div class="flex flex-wrap gap-3">
                    <template x-for="time in timeSlots" :key="'end-'+time">
                        <button
                            @click="selectEndTime(time)"
                            x-text="time"
                            :disabled="!selectedStart || disabledEndTimes.includes(time)"
                            class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 transition"
                            :class="{
                                'bg-blue-600 text-white border-blue-600': selectedEnd === time,
                                'opacity-40 cursor-not-allowed': !selectedStart || disabledEndTimes.includes(time),
                                'hover:bg-blue-100': selectedStart && !disabledEndTimes.includes(time)
                            }"
                        ></button>
                    </template>
                </div>
            </div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="flex justify-end mt-10">
            <x-button variant="gradient" style="fill" type="button" @click="goNextStep()">Next →</x-button>
        </div>
    </div>

    {{-- STEP 2: Select Reservation Activity --}}
    <div x-show="step === 2" x-transition>
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Select Reservation Activity</h2>
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-10">
                <div class="h-1.5 bg-blue-600 rounded-full" style="width:40%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-center mb-6">Select Reservation Activity</h1>

        <div class="grid grid-cols-1 gap-4">
            <template x-for="(activity, i) in activities" :key="i">
                <label 
                    class="flex items-center space-x-3 p-4 border rounded-2xl cursor-pointer transition hover:shadow-lg"
                    :class="activity.selected ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-white'"
                    @click="selectActivity(activity.value)"
                >
                    <input 
                        type="radio" 
                        name="activity-group" 
                        :value="activity.value" 
                        x-model="form.activity"
                        class="hidden"
                    />
                    <div class="w-5 h-5 rounded-full border-2 border-blue-500 flex items-center justify-center">
                        <div x-show="form.activity === activity.value" class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-lg" x-text="activity.label"></span>
                        <span class="text-gray-500" x-text="activity.description"></span>
                    </div>
                </label>
            </template>
        </div>

        <div class="mt-8 flex justify-between">
            <x-button variant="tertiary" style="outline" type="button" @click="step--">← Back</x-button>
            <x-button variant="gradient" style="fill" type="button" @click="goToStep3()">Next →</x-button>
        </div>
    </div>

	    {{-- STEP 3: Select Users --}}
    <div x-show="step === 3" x-transition>
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Select Users</h2>
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-10">
                <div class="h-1.5 bg-blue-600 rounded-full" style="width:60%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-center mb-6">Select Users</h1>

        <div class="space-y-4">
            {{-- Using Alone --}}
            <label 
                class="flex flex-col p-5 border rounded-2xl cursor-pointer transition hover:shadow-lg"
                :class="form.userType === 'alone' ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-white'"
                @click="form.userType = 'alone'; form.totalParticipants = 1"
            >
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 rounded-full border-2 border-blue-500 flex items-center justify-center mt-1">
                        <div x-show="form.userType === 'alone'" class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                    </div>
                    <div>
                        <span class="font-semibold text-lg">Using Alone</span>
                        <p class="text-gray-500">I will be in charge and be using the studio by myself.</p>
                    </div>
                </div>
            </label>

            {{-- Using With Others --}}
            <label 
                class="flex flex-col p-5 border rounded-2xl cursor-pointer transition hover:shadow-lg"
                :class="form.userType === 'multi' ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-white'"
                @click="form.userType = 'multi'"
            >
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 rounded-full border-2 border-blue-500 flex items-center justify-center mt-1">
                        <div x-show="form.userType === 'multi'" class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold text-lg">Using With Others</span>
                        <p class="text-gray-500">I will be in charge and be using the studio with other people.</p>

                        {{-- Total Participants --}}
                        <div class="mt-4" x-show="form.userType === 'multi'" x-transition>
                            <label class="block text-sm font-semibold mb-1">Total Participants</label>
                            <input type="number" value="2" min="2" class="w-28 border border-gray-300 rounded-full px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" x-model.number="form.totalParticipants" x-init="form.totalParticipants = 2">
                        </div>
                    </div>
                </div>
            </label>
        </div>

        <div class="mt-10 flex justify-between">
            <x-button variant="tertiary" style="outline" type="button" @click="step--">← Back</x-button>
            <x-button variant="gradient" style="fill" type="button" @click="goToStep4()">Next →</x-button>
        </div>
    </div>

	    {{-- STEP 4: Usage Purposes --}}
    <div x-show="step === 4" x-transition>
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Usage Purposes</h2>
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-10">
                <div class="h-1.5 bg-blue-600 rounded-full" style="width:80%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-center mb-10">Describe Your Usage Purposes</h1>

        <div class="max-w-2xl mx-auto space-y-8">
            {{-- Description --}}
            <div>
                <label class="block font-semibold text-lg mb-1">Description</label>
                <p class="text-gray-500 mb-2">
                    You may explain a little bit more about what you are going to do or maybe the items you are going to use.
                </p>
                <textarea
                    x-model="form.description"
                    placeholder="Description"
                    rows="5"
                    class="w-full border border-gray-300 rounded-2xl p-4 resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none"
                ></textarea>
            </div>

            {{-- Agreement Checkbox --}}
            <div class="flex items-start space-x-3">
                <input
                    id="agree"
                    type="checkbox"
                    x-model="form.agree"
                    class="mt-1 w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
                >
                <label for="agree" class="text-gray-700 leading-tight">
                    I agree to follow the
                    <a href="#" class="text-blue-600 hover:underline">rules</a>
                    and will be responsible for any activity that I am about to make.
                </label>
            </div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="mt-10 flex justify-between max-w-2xl mx-auto">
            <x-button variant="tertiary" style="outline" type="button" @click="step--">← Back</x-button>
            <x-button
                variant="gradient"
                style="fill"
                type="button"
                @click="goToStep5()"
                class="disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Finish →
            </x-button>
        </div>
    </div>

    {{-- STEP 5: Summary & Confirmation --}}
    <div x-show="step === 5" x-transition>
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Review Your Reservation</h2>
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-10">
                <div class="h-1.5 bg-blue-600 rounded-full" style="width:100%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-center mb-10">Confirm Your Reservation</h1>

        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8 space-y-6 border border-gray-100">
            {{-- Reservation Details --}}
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">Reservation Details</h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Date:</strong> <span x-text="form.date"></span></li>
                    <li><strong>Start Time:</strong> <span x-text="form.start"></span></li>
                    <li><strong>End Time:</strong> <span x-text="form.end"></span></li>
                    <li><strong>Activity:</strong> <span x-text="displayActivityLabel()"></span></li>
                </ul>
            </div>

            {{-- User Info --}}
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">User Information</h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>User Type:</strong> 
                        <span x-text="form.userType === 'alone' ? 'Using Alone' : 'With Others'"></span>
                    </li>
                    <template x-if="form.userType === 'multi'">
                        <li><strong>Total Participants:</strong> <span x-text="form.totalParticipants"></span></li>
                    </template>
                </ul>
            </div>

            {{-- Description --}}
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">Usage Description</h3>
                <p class="text-gray-700 whitespace-pre-line border border-gray-200 rounded-xl p-4 bg-gray-50" x-text="form.description"></p>
            </div>

            {{-- Agreement --}}
            <div class="flex items-center space-x-2 text-gray-700">
                <input type="checkbox" checked disabled class="w-4 h-4 rounded border-gray-400 text-blue-600" />
                <label>I have agreed to follow the rules and take responsibility for my activity.</label>
            </div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="mt-10 flex justify-between max-w-3xl mx-auto">
            <x-button variant="tertiary" style="outline" type="button" @click="step--">← Back</x-button>
            <x-button variant="gradient" style="fill" type="button" @click="submitReservation()">Submit Reservation</x-button>
        </div>
    </div>

    {{-- Fade Alerts --}}
    @if (session('error'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-transition.opacity.duration.500ms
            x-init="setTimeout(() => show = false, 8000)"
            class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-start justify-between space-x-4 w-[300px]"
        >
            <span>{{ session('error') }}</span>
            <x-button variant="tertiary" style="outline" class="!px-2 !py-1 !rounded-full" @click="show = false">&times;</x-button>
        </div>
    @endif

    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-transition.opacity.duration.500ms
            x-init="setTimeout(() => show = false, 8000)"
            class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-start justify-between space-x-4 w-[300px]"
        >
            <span>{{ session('success') }}</span>
            <x-button variant="tertiary" style="outline" class="!px-2 !py-1 !rounded-full" @click="show = false">&times;</x-button>
        </div>
    @endif
</div>

{{-- Alpine Script --}}
<script>
function calendarComponent() {
    return {
        step: 1,
        form: {
            date: '', start: '', end: '', activity: '',
            userType: '', totalParticipants: 1,
            description: '', agree: false
        },
        today: new Date(),
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        selectedDate: null,
        selectedStart: null,
        selectedEnd: null,
        unavailableTimes: [],       // times occupied by DB (e.g. ['01:00 PM','01:30 PM','02:00 PM'])
        disabledEndTimes: [],       // computed disabled end times based on selected start + unavailableTimes
        daysShort: ['S','M','T','W','T','F','S'],
        monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
        timeSlots: [
            '11:30 AM','12:00 PM','12:30 PM','01:00 PM','01:30 PM','02:00 PM','02:30 PM',
            '03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','05:30 PM','06:00 PM'
        ],

        /* --- Calendar helpers (unchanged) --- */
        _monthYearForOffset(offset) {
            const baseTotal = this.currentMonth + offset;
            const yearOffset = Math.floor(baseTotal / 12);
            const monthIndex = ((baseTotal % 12) + 12) % 12;
            const year = this.currentYear + yearOffset;
            return { monthIndex, year };
        },
        daysArray(offset = 0) {
            const { monthIndex, year } = this._monthYearForOffset(offset);
            const firstDayIndex = new Date(year, monthIndex, 1).getDay();
            const daysInMonth = new Date(year, monthIndex + 1, 0).getDate();
            const arr = [];
            for (let i = 0; i < firstDayIndex; i++) arr.push({ day: '', date: null, _key: `b-${offset}-${i}` });
            for (let d = 1; d <= daysInMonth; d++) arr.push({ day: d, date: new Date(year, monthIndex, d), _key: `d-${offset}-${d}` });
            const cellsNeeded = Math.ceil(arr.length / 7) * 7;
            while (arr.length < cellsNeeded) arr.push({ day: '', date: null, _key: `t-${offset}-${arr.length}` });
            return arr;
        },

        /* --- IMPORTANT: getters for right-side month title --- */
        get nextMonthIndex() {
            return (this.currentMonth + 1) % 12;
        },
        get nextYear() {
            return this.currentMonth === 11 ? this.currentYear + 1 : this.currentYear;
        },

        isSameDate(d1, d2) {
            if (!d1 || !d2) return false;
            return new Date(d1).toDateString() === new Date(d2).toDateString();
        },
        prevMonth() { if (this.currentMonth === 0) { this.currentMonth = 11; this.currentYear--; } else this.currentMonth--; },
        nextMonthClick() { if (this.currentMonth === 11) { this.currentMonth = 0; this.currentYear++; } else this.currentMonth++; },

        /* --- When user picks a date --- */
        selectDate(dateObj) {
            if (!dateObj) return;
            this.selectedDate = new Date(dateObj.getFullYear(), dateObj.getMonth(), dateObj.getDate());

            // Send only YYYY-MM-DD to backend
            const yyyy = this.selectedDate.getFullYear();
            const mm = String(this.selectedDate.getMonth() + 1).padStart(2, '0');
            const dd = String(this.selectedDate.getDate()).padStart(2, '0');

            this.form.date = `${yyyy}-${mm}-${dd}`;

            this.selectedStart = null;
            this.selectedEnd = null;
            this.form.start = '';
            this.form.end = '';
            this.disabledEndTimes = [];
            this.unavailableTimes = [];
            this.fetchUnavailableTimes();

            
        },

        isPastDate(date) {
            if (!date) return true;
            const today = new Date();
            today.setHours(0,0,0,0);
            const check = new Date(date);
            check.setHours(0,0,0,0);
            return check < today;
        },

        isPastTime(timeStr) {
            const now = new Date();
            const [time, modifier] = timeStr.split(' '); // ["01:30", "PM"]
            let [hours, minutes] = time.split(':').map(Number);

            if (modifier === 'PM' && hours !== 12) hours += 12;
            if (modifier === 'AM' && hours === 12) hours = 0;

            const slotMinutes = hours * 60 + minutes;
            const nowMinutes = now.getHours() * 60 + now.getMinutes();

            return slotMinutes < nowMinutes;
        },

        formatFullDate(date) {
            if (!date) return '';
            const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

            const dayName = days[date.getDay()];
            const day = date.getDate();
            const monthName = months[date.getMonth()];
            const year = date.getFullYear();

            // Add ordinal suffix (1st, 2nd, 3rd, 4th...)
            const ordinal = (n) => {
                if (n > 3 && n < 21) return n + 'th';
                switch (n % 10) {
                    case 1: return n + 'st';
                    case 2: return n + 'nd';
                    case 3: return n + 'rd';
                    default: return n + 'th';
                }
            }

            return `${dayName}, ${ordinal(day)} ${monthName} ${year}`;
        },

        displayActivityLabel() { 
            const act = this.activities.find(a => a.value === this.form.activity);
            return act ? act.label : '';
        },

        /* --- Fetch unavailable times from database via Laravel route --- */
        async fetchUnavailableTimes() {
            const dateStr = this.selectedDate.getFullYear() + '-' +
            String(this.selectedDate.getMonth() + 1).padStart(2, '0') + '-' +
            String(this.selectedDate.getDate()).padStart(2, '0');


            try {
                const res = await fetch(`/available-times?date=${dateStr}`);
                const data = await res.json();

                if (!data.bookedTimes || data.bookedTimes.length === 0) {
                    this.unavailableTimes = [];
                    return;
                }

                const allTimes = this.timeSlots;
                const unavailable = [];

                data.bookedTimes.forEach(entry => {
                    const startIdx = allTimes.indexOf(entry.start);
                    const endIdx = allTimes.indexOf(entry.end);
                    if (startIdx !== -1 && endIdx !== -1) {
                        unavailable.push(...allTimes.slice(startIdx, endIdx));
                    }
                });

                this.unavailableTimes = unavailable;
                console.log("Unavailable times:", this.unavailableTimes); // 🧩 Debug check
            } catch (err) {
                console.error("Error fetching times:", err);
                this.unavailableTimes = [];
            }
        },

        /* --- Start time selection --- */
        selectStartTime(time) {
            // blocked start times must not be selectable
            if (!this.selectedDate) return;
            if (this.unavailableTimes.includes(time)) return;
            this.selectedStart = time;
            this.form.start = time;
            this.selectedEnd = null;
            this.form.end = '';
            this.updateEndTimeAvailability();
        },

        /* --- End time selection --- */
        selectEndTime(time) {
            if (!this.selectedStart) return;
            if (this.disabledEndTimes.includes(time)) return;
            this.selectedEnd = time;
            this.form.end = time;
        },

        updateEndTimeAvailability() {
            const all = this.timeSlots;
            if (!this.selectedStart) {
                this.disabledEndTimes = [];
                return;
            }

            const startIndex = all.indexOf(this.selectedStart);

            if (!this.unavailableTimes || this.unavailableTimes.length === 0) {
                // no bookings → disable times <= startIndex
                this.disabledEndTimes = all.filter((t, i) => i <= startIndex);
                return;
            }

            // Convert unavailableTimes to indices in timeSlots
            const bookedIndices = this.unavailableTimes
                .map(t => all.indexOf(t))
                .filter(i => i !== -1)
                .sort((a,b) => a - b);

            // Find the first booked index **after** selected start
            const nextBookedIndex = bookedIndices.find(i => i > startIndex);

            this.disabledEndTimes = all.filter((t, i) => {
                // disable times at or before start
                if (i <= startIndex) return true;

                // disable times after next booked start (can end exactly at booked start)
                if (nextBookedIndex !== undefined && i > nextBookedIndex) return true;

                return false; // enabled
            });
        },

        /* --- Step navigation & validation --- */
        goNextStep() {
            if (!this.selectedDate || !this.selectedStart || !this.selectedEnd) {
                popup('Please select date, start, and end time before continuing.', 'error');
                return;
            }
            this.step = 2;
        },

        /* --- Steps 2..5 --- */
        activities: [
            { value: 'recording', label: 'Recording Session', description: 'Use our studio to record audio or music.', selected: false },
            { value: 'practice', label: 'Practice Session', description: 'Practice your instruments or rehearsal.', selected: false },
            { value: 'meeting', label: 'Meeting / Event', description: 'Host a meeting or event in the space.', selected: false },
            { value: 'photography', label: 'Photography', description: 'Photo shoot with lighting and backdrop.', selected: false }
        ],
        selectActivity(val) {
            this.form.activity = val;
            this.activities.forEach(a => a.selected = (a.value === val));
        },
        goToStep3() {
            if (!this.form.activity) { popup('Please select an activity to proceed.', 'error'); return; }
            this.step = 3;
        },
        goToStep4() {
            if (!this.form.userType) { popup('Please select how you will be using the studio before continuing.', 'error'); return; }
            this.step = 4;
        },
        goToStep5() {
            if (!this.form.description.trim()) { popup('Please provide a short description of your usage.', 'error'); return; }
            if (!this.form.agree) { popup('Please agree to the rules before continuing.', 'error'); return; }
            this.step = 5;
        },

        // Helper: convert "01:30 PM" -> "13:30:00"
        convertTo24Hour(timeStr) {
            if (!timeStr) return '';
            const [time, modifier] = timeStr.split(' '); // ["01:30", "PM"]
            let [hours, minutes] = time.split(':').map(Number);

            if (modifier === 'PM' && hours < 12) hours += 12;
            if (modifier === 'AM' && hours === 12) hours = 0;

            const hh = String(hours).padStart(2, '0');
            const mm = String(minutes).padStart(2, '0');

            return `${hh}:${mm}:00`; // MySQL datetime format
        },

        async submitReservation() {
            if (!this.form.date || !this.form.start || !this.form.end) {
                popup('Missing date or time selection!', 'error');
                return;
            }
            if (!this.form.activity || !this.form.userType || !this.form.description.trim() || !this.form.agree) {
                popup('Please complete all required fields and agree to rules!', 'error');
                return;
            }

            const payload = {
                date: this.form.date, // YYYY-MM-DD
                start: this.convertTo24Hour(this.form.start),
                end: this.convertTo24Hour(this.form.end),
                activity: this.form.activity,
                userType: this.form.userType,
                totalParticipants: this.form.totalParticipants,
                description: this.form.description
            };

            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const res = await fetch('/reserve', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.success && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    if (data.errors) {
                        alert(Object.values(data.errors).flat().join('\n'));
                    } else {
                        popup(data.message || 'Something went wrong.', 'error');
                    }
                }
            } catch (err) {
                console.error(err);
                popup('Failed to submit reservation. Check your connection.', 'error');
            }
        },
    };
}
</script>
@endsection
