@extends('layouts.layout')

@section('content')
{{-- content --}}
<div class="flex justify-center mt-10 flex-col gap-10">
  <form action="/" method="POST">
    @csrf
    {{-- input --}}
    <label class="form-control w-full max-w-lg mx-auto">
      <div class="label">
        <span class="label-text text-emerald-600">Task Baru</span>
      </div>
      <input name="task" type="text" placeholder="Type here"
        class="input input-bordered input-success w-full max-w-lg" />
      @error('task')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
      <div class="label">
      </div>
      {{-- button add --}}
      <button type="submit" class="btn btn-success w-36 self-center">Add</button>
      {{-- akhir button add --}}
    </label>
    {{-- akhir input --}}
  </form>

   {{-- task --}}
   <div class="flex flex-col gap-3 mb-10">
    @php
    $i = 1;
    @endphp
    @foreach ($tasks as $task)
    {{-- task 1 --}}
    <div role="alert" class="alert max-w-4xl mx-auto">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <div class="flex flex-col">
        <span class="text-sm text-slate-400">{{ $task->tanggal }}</span>
        <span class="text-xl font-bold">{{ $task->task }}</span>
      </div>
      <div>
        <div class="tooltip" data-tip="Detail">
          <a href="/{{ $task->task_id }}" class="btn btn-sm shadow-lg bg-base-200">View</a>
        </div>
        <div class="tooltip" data-tip="Edit">
          <a href="/edit/{{ $task->task_id }}" class="btn btn-sm shadow-lg bg-yellow-500">Edit</a>
        </div>
        <div class="tooltip" data-tip="Selesai">
          <!-- Open the modal using ID.showModal() method -->
          <button class="btn btn-sm btn-success" onclick="tombol_{{ $i }}.showModal()">Done</button>
        </div>
      </div>
    </div>
    {{-- akhir task 1 --}}
    {{-- Modal --}}
    <dialog id="tombol_{{ $i }}" class="modal">
      <div class="modal-box">
        <h3 class="font-bold text-3xl text-center">Done With This Task?</h3>
        <p class="py-4 text-red-400 text-center">You Will Remove <span class="font-bold">"{{ $task->task }}"</span> From
          Your List</p> 
        <form action="/deleteTask/{{ $task->id }}" method="POST" class="flex justify-center">
          @method('DELETE')
          @csrf
          <button class="btn btn-sm btn-success" type="submit">Done</button>
        </form>
      </div>
      <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
    </dialog>
    {{-- akhir Modal --}}
    @php
    $i++;
    @endphp
    @endforeach
  </div>
  {{-- akhir task --}}

@section('footer')
{{-- footer --}}
<footer class="footer footer-center p-4 bg-base-300 text-base-content">
  <aside>
    <p>Copyright © 2024 - All right reserved by Najdain Tafdhila</p>
  </aside>
</footer>
{{-- footer --}}
@endsection