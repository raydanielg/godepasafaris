@php
    $locales     = config('locales.supported', []);
    $current     = app()->getLocale();
    $currentMeta = $locales[$current] ?? reset($locales);
    // "compact" => pill button for the desktop navbar; "block" => full-width for the mobile sidebar.
    $variant = $variant ?? 'compact';
@endphp

<div class="dropdown lang-switcher lang-switcher--{{ $variant }}">
    <button class="btn lang-switcher__toggle {{ $variant === 'block' ? 'w-100' : '' }} rounded-pill dropdown-toggle d-flex align-items-center justify-content-center gap-2"
            type="button"
            id="langSwitcher-{{ $variant }}"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            aria-label="{{ __('messages.lang_switcher.choose') }}">
        <img class="lang-switcher__flag-img"
             src="https://flagcdn.com/24x18/{{ $currentMeta['country'] ?? 'gb' }}.png"
             srcset="https://flagcdn.com/48x36/{{ $currentMeta['country'] ?? 'gb' }}.png 2x"
             width="24" height="18" alt="" aria-hidden="true" decoding="async"
             onerror="this.style.display='none';this.nextElementSibling.style.display='inline';">
        <span class="lang-switcher__flag" aria-hidden="true" style="display:none;">{{ $currentMeta['flag'] }}</span>
        <span class="lang-switcher__label">{{ $currentMeta['native'] }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 lang-switcher__menu" aria-labelledby="langSwitcher-{{ $variant }}">
        <li><h6 class="dropdown-header">{{ __('messages.lang_switcher.choose') }}</h6></li>
        @foreach($locales as $code => $meta)
            <li>
                <a class="dropdown-item d-flex align-items-center gap-2 {{ $code === $current ? 'active' : '' }}"
                   href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}"
                   lang="{{ $meta['hreflang'] }}"
                   hreflang="{{ $meta['hreflang'] }}">
                    <img class="lang-switcher__flag-img"
                         src="https://flagcdn.com/24x18/{{ $meta['country'] ?? 'gb' }}.png"
                         srcset="https://flagcdn.com/48x36/{{ $meta['country'] ?? 'gb' }}.png 2x"
                         width="24" height="18" alt="" aria-hidden="true" loading="lazy" decoding="async"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='inline';">
                    <span aria-hidden="true" style="display:none;">{{ $meta['flag'] }}</span>
                    <span>{{ $meta['native'] }}</span>
                    @if($code === $current)
                        <i class="fas fa-check ms-auto small" style="color: #8B4513;"></i>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .lang-switcher__toggle {
        background-color: #fff;
        border: 1.5px solid rgba(139, 69, 19, 0.25);
        color: #3E2723;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 7px 14px;
        transition: all 0.25s ease;
    }
    .lang-switcher__toggle:hover,
    .lang-switcher__toggle:focus {
        border-color: #8B4513;
        color: #8B4513;
        background-color: #fdfaf5;
    }
    .lang-switcher__flag { font-size: 1rem; line-height: 1; }
    .lang-switcher__flag-img {
        width: 22px;
        height: 16px;
        object-fit: cover;
        border-radius: 3px;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08);
        flex-shrink: 0;
    }
    .lang-switcher__menu { border-radius: 12px; padding: 8px; min-width: 200px; }
    .lang-switcher__menu .dropdown-item { border-radius: 8px; padding: 8px 12px; font-weight: 500; }
    .lang-switcher__menu .dropdown-item:hover { background: rgba(139, 69, 19, 0.08); }
    .lang-switcher__menu .dropdown-item.active { background: rgba(139, 69, 19, 0.12); color: #3E2723; }
    .lang-switcher--block .lang-switcher__toggle { justify-content: space-between; padding: 12px 16px; }
</style>
