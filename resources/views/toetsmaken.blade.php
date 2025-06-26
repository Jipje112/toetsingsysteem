<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1>hello</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 max-h-96 overflow-y-auto space-y-3 pr-2" >
                <x-links class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 max-h-96 overflow-y-auto space-y-3 pr-2">
                <x-thisfilewillbedeletedafterwardscapybara class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-xl font-bold mb-4">Meerkeuzevragen</h2>

                <!-- Filter by Test -->
                <form method="GET" action="{{ route('toetsmaken') }}" class="mb-4 flex items-center gap-2">
                    <label for="filter" class="font-semibold">Filter op toets:</label>
                    <select name="filter" id="filter" class="border p-2 rounded" onchange="this.form.submit()">
                        <option value="">Alle toetsen</option>
                        @foreach ($tests as $test)
                            <option value="{{ $test->id }}" {{ request('filter') == $test->id ? 'selected' : '' }}>
                                {{ $test->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <!-- Create New Question -->
                <form method="POST" action="{{ route('question.store') }}" class="mb-6 space-y-4">
                    @csrf
                    <div>
                        <label for="question">Vraag</label>
                        <input type="text" name="question" required class="border p-2 rounded w-full">
                    </div>

                    <div>
                        <label for="testnameID">Selecteer toets</label>
                        <select name="testnameID" required class="border p-2 rounded w-full">
                            @foreach ($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="correct_answer">Correct antwoord?</label>
                        <input type="radio" name="correct_answer" value="1" checked id="correct_answer">
                        <label for="correct_answer">Ja</label>
                        <input type="radio" name="correct_answer" value="0" id="incorrect_answer">
                        <label for="incorrect_answer">Nee</label>
                    </div>

                    <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded">Vraag toevoegen</button>
                </form>

                <!-- List of Questions -->
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    @foreach ($questions as $question)
                        <div class="border p-4 rounded">
                            <form method="POST" action="{{ route('question.update', $question->id) }}" class="space-y-2">
                                @csrf
                                <input type="text" name="question" value="{{ $question->question }}" class="w-full border p-2 rounded">

                                <select name="testnameID" class="border p-2 rounded w-full">
                                    @foreach ($tests as $test)
                                        <option value="{{ $test->id }}" {{ $question->testnameID == $test->id ? 'selected' : '' }}>
                                            {{ $test->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="1" {{ $question->correct_answer ? 'checked' : '' }} id="correct_answer_{{ $question->id }}">
                                    <label for="correct_answer_{{ $question->id }}">Correct antwoord</label>
                                    <input type="radio" name="correct_answer" value="0" {{ !$question->correct_answer ? 'checked' : '' }} id="incorrect_answer_{{ $question->id }}">
                                    <label for="incorrect_answer_{{ $question->id }}">Incorrect antwoord</label>
                                </div>

                                <div class="flex justify-between">
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
                                    <a href="{{ route('question.delete', $question->id) }}" class="text-red-600">Verwijder</a>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6 space-y-6">
                        <h1 class="text-2xl font-bold">Toetsen</h1>

                        <!-- Add New Test -->
                        <form method="POST" action="{{ route('toets.store') }}" class="space-x-2">
                            @csrf
                            <input type="text" name="name" placeholder="Nieuwe toets naam" required class="border p-2 rounded">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Toevoegen</button>
                        </form>

                        <!-- List of Tests -->
                        <div class="max-h-96 overflow-y-auto space-y-3 pr-2">
                            @foreach ($tests as $test)
                                <div class="border p-4 rounded flex justify-between items-center">
                                    <form method="POST" action="{{ route('toets.update', $test->id) }}" class="flex space-x-2 items-center">
                                        @csrf
                                        <input type="text" name="name" value="{{ $test->name }}" class="border p-1 rounded">
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                                    </form>
                                    <a href="{{ route('toets.delete', $test->id) }}" class="text-red-500">Verwijder</a>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
