@extends('layouts.main')

@section('title', $event->title)

@section('content')

<section id="event-show-container">
    <img
        class="event-show-image"
        src="{{ $event->image ? asset('img/events/' . $event->image) : asset('img/banner.svg') }}"
        alt="Imagem do evento {{ $event->title }}"
    >

    <div class="event-show-info">
        <h1>{{ $event->title }}</h1>

        <p class="event-location">{{ $event->city }}</p>
        <p class="event-date-detail">
            {{ $event->date ? $event->date->format('d/m/Y') : 'Data a definir' }}
        </p>
        <p class="event-privacy">
            {{ $event->private ? 'Evento privado' : 'Evento público' }}
        </p>

        <h3>O evento conta com:</h3>

        <ul class="items-list">
            @forelse($event->items ?? [] as $item)
                <li>{{ $item }}</li>
            @empty
                <li>Nenhum item cadastrado.</li>
            @endforelse
        </ul>

        <h3>Sobre o evento</h3>
        <p class="event-description">{{ $event->description }}</p>

        <a href="{{ url('/') }}" class="btn-secondary">Voltar para eventos</a>
    </div>
</section>

@endsection
