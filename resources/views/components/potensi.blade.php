<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Potensi</h2>
            <h3 class="section-subheading text-muted">Potensi Desa Dalisodo</h3>
        </div>
        <div class="row text-center">
            @if ($potensi->count())
                @foreach ($potensi as $item)
                    <div class="col-md-4">
                        @if ($item->media->tipe_media == 'Gambar')
                            @php
                                $gambar = Yaza\LaravelGoogleDriveStorage\Gdrive::get($item->media->file_id);
                                $base64Gambar = base64_encode($gambar->file);
                            @endphp

                            <div class="image-container">
                                <img src="data:image/jpeg;base64,{{ $base64Gambar }}" style="width: 320px; height: 240px"
                                    alt="{{ $item->judul }}" class="img-fluid" />
                                <button class="btn-show"
                                    onclick="window.location.href='{{ route('detail', ['slug' => $item->slug, 'type' => 'potensi']) }}'">
                                    See more
                                </button>
                            </div>
                        @elseif($item->media->tipe_media == 'Youtube')
                            <div class="image-container">
                                <img src="https://img.youtube.com/vi/{{ $item->media->youtube_id }}/hqdefault.jpg"
                                    alt="YouTube Thumbnail" style="width: 320px; height: 240px; border-radius: 8px;">
                                <button class="btn-show"
                                    onclick="window.location.href='{{ route('detail', ['slug' => $item->slug, 'type' => 'potensi']) }}'">
                                    See more
                                </button>
                            </div>
                        @endif
                        <h4 class="my-3 text-judul">{{ $item->judul }}</h4>
                        @php
                            $item->deskripsi = strip_tags($item->deskripsi, '<strong><em><u><ul><ol><li><a>');
                            $item->deskripsi =
                                strlen($item->deskripsi) > 100
                                    ? substr($item->deskripsi, 0, 100) . '...'
                                    : $item->deskripsi;
                        @endphp
                        <p class="text-deskripsi">{!! $item->deskripsi !!}</p>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    Potensi desa tidak tersedia
                </div>
            @endif
        </div>

        <nav aria-label="page navigation" class="d-flex justify-content-center my-3">
            @if (!empty($potensi))
                {{ $potensi->appends(['berita' => request('berita')])->links('pagination::bootstrap-4') }}
            @endif
        </nav>
    </div>
</section>
