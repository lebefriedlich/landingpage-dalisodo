<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Berita</h2>
            <h3 class="section-subheading text-muted">Berita di Desa Dalisodo</h3>
        </div>
        <div class="row text-center">
            @if (!empty($berita))
                @foreach ($berita as $item)
                    <div class="col-md-4">
                        @if ($item->media->tipe_media == 'Gambar')
                            <div class="image-container">
                                <img src="{{ $item->media->file_id }}" style="width: 320px; height: 240px"
                                    alt="{{ $item->judul }}" class="img-fluid" />
                                <button class="btn-show"
                                    onclick="window.location.href='{{ route('detail', ['type' => 'berita', 'slug' => $item->slug]) }}'">
                                    See more
                                </button>
                            </div>
                        @elseif($item->media->tipe_media == 'Youtube')
                            <div class="image-container">
                                    <img src="https://img.youtube.com/vi/{{ $item->media->youtube_id }}/hqdefault.jpg"
                                        alt="YouTube Thumbnail"
                                        style="width: 320px; height: 240px; border-radius: 8px;">
                                <button class="btn-show"
                                    onclick="window.location.href='{{ route('detail', ['type' => 'berita', 'slug' => $item->slug]) }}'">
                                    See more
                                </button>
                            </div>
                        @endif
                        <h4 class="my-3 text-judul">{{ $item->judul }}</h4>
                        @php
                            $item->konten = strip_tags($item->konten, '<strong><em><u><ul><ol><li><a>');
                            $item->konten =
                                strlen($item->konten) > 100 ? substr($item->konten, 0, 100) . '...' : $item->konten;
                        @endphp
                        <p class="text-deskripsi">{!! $item->konten !!}</p>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    Berita tidak tersedia
                </div>
            @endif
        </div>
        <nav aria-label="page navigation" class="d-flex justify-content-center my-3">
            @if (!empty($berita))
                {{ $berita->appends(['potensi' => request('potensi')])->links('pagination::bootstrap-4') }}
            @endif
        </nav>
    </div>
</section>
