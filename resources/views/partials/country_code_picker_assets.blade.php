{{-- ============================================================
     Searchable country-code picker with flag images.
     Progressive enhancement: the real <select name="phone_country_code">
     stays in the DOM (hidden) and remains the submitted, validated control —
     so if this JS ever fails, the native dropdown still works. Type to filter
     by country name OR dialling code (e.g. "t" -> Tanzania).

     Included from BOTH booking_modal and general_inquiry_modal so the picker
     works on every page that shows either form. The JS guards itself with a
     one-time flag, so including it twice on one page is harmless.
     ============================================================ --}}
<style>
    .country-picker { position: relative; flex: 0 0 auto; }
    .country-picker__trigger {
        display: flex; align-items: center; gap: .35rem;
        height: 100%; min-height: 38px; padding: .45rem .55rem;
        background: #f8f9fa; border: 0; cursor: pointer;
        font-size: .95rem; color: #333; white-space: nowrap;
    }
    .country-picker__trigger:focus-visible { outline: 2px solid rgba(139,69,19,.4); outline-offset: -2px; }
    .cp-flag { width: 20px; height: 15px; object-fit: cover; border-radius: 2px; box-shadow: 0 0 0 1px rgba(0,0,0,.08); flex: 0 0 auto; }
    .country-picker__caret { font-size: .65rem; opacity: .55; margin-left: .1rem; }
    .country-picker__panel {
        position: absolute; top: calc(100% + 4px); left: 0; z-index: 2000;
        width: 290px; max-width: 82vw; background: #fff;
        border: 1px solid #e5e5e5; border-radius: .5rem;
        box-shadow: 0 12px 34px rgba(0,0,0,.16); overflow: hidden; display: none;
    }
    .country-picker.open .country-picker__panel { display: block; }
    .country-picker__search { width: 100%; border: 0; border-bottom: 1px solid #eee; padding: .6rem .75rem; font-size: .9rem; outline: none; }
    .country-picker__list { max-height: 240px; overflow-y: auto; list-style: none; margin: 0; padding: .25rem; }
    .country-picker__list li { display: flex; align-items: center; gap: .55rem; padding: .5rem .6rem; border-radius: .375rem; cursor: pointer; font-size: .9rem; }
    .country-picker__list li.active, .country-picker__list li:hover { background: #f3ece4; }
    .country-picker__list li.selected { font-weight: 600; }
    .country-picker__list li .cp-name { overflow: hidden; text-overflow: ellipsis; }
    .country-picker__list li .cp-code { margin-left: auto; color: #8a8a8a; font-size: .8rem; }
    .country-picker__empty { padding: .8rem; text-align: center; color: #999; font-size: .85rem; }
</style>
<script>
(function () {
    if (window.__countryPickerInit) return;   // guard: run once even if included twice
    window.__countryPickerInit = true;

    var FLAG = function (iso) { return 'https://flagcdn.com/40x30/' + iso + '.png'; };

    function build(select) {
        if (!select || select.dataset.cpEnhanced) return;
        select.dataset.cpEnhanced = '1';

        // Read the country list straight from the <option>s (single source of truth).
        var items = Array.prototype.map.call(select.options, function (o) {
            return { value: o.value, iso: (o.dataset.iso || '').toLowerCase(),
                     name: o.dataset.name || o.textContent.trim() };
        });

        // Wrapper takes the select's place in the input-group; select is hidden inside it.
        var wrap = document.createElement('div');
        wrap.className = 'country-picker';
        select.parentNode.insertBefore(wrap, select);
        wrap.appendChild(select);
        select.style.display = 'none';
        select.setAttribute('tabindex', '-1');
        select.setAttribute('aria-hidden', 'true');

        var trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'country-picker__trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        trigger.innerHTML = '<img class="cp-flag" alt="" loading="lazy">'
                          + '<span class="cp-current"></span>'
                          + '<span class="country-picker__caret">▼</span>';
        wrap.appendChild(trigger);

        var panel = document.createElement('div');
        panel.className = 'country-picker__panel';
        panel.innerHTML = '<input type="text" class="country-picker__search" '
                        + 'placeholder="Search country or code…" aria-label="Search country">'
                        + '<ul class="country-picker__list" role="listbox"></ul>';
        wrap.appendChild(panel);

        var search = panel.querySelector('.country-picker__search');
        var list = panel.querySelector('.country-picker__list');
        var triggerFlag = trigger.querySelector('.cp-flag');
        var triggerText = trigger.querySelector('.cp-current');

        function flagImg(iso) {
            var img = document.createElement('img');
            img.className = 'cp-flag'; img.alt = ''; img.loading = 'lazy'; img.src = FLAG(iso);
            img.onerror = function () { img.style.display = 'none'; }; // flags blocked? keep code visible
            return img;
        }

        function syncTrigger() {
            var it = items.find(function (i) { return i.value === select.value; }) || items[0];
            if (!it) return;
            triggerFlag.src = FLAG(it.iso);
            triggerFlag.style.display = '';
            triggerFlag.onerror = function () { triggerFlag.style.display = 'none'; };
            triggerText.textContent = it.value; // compact: just the dialling code
            trigger.setAttribute('title', it.name + ' (' + it.value + ')');
        }

        function render(filter) {
            filter = (filter || '').trim().toLowerCase();
            list.innerHTML = '';
            var matches = items.filter(function (i) {
                return !filter || i.name.toLowerCase().indexOf(filter) !== -1
                    || i.value.toLowerCase().indexOf(filter) !== -1
                    || i.iso === filter;
            });
            if (!matches.length) {
                var empty = document.createElement('div');
                empty.className = 'country-picker__empty';
                empty.textContent = 'No match. Try a country name or a code like 255.';
                list.appendChild(empty);
                return;
            }
            matches.forEach(function (i, idx) {
                var li = document.createElement('li');
                li.setAttribute('role', 'option');
                li.dataset.value = i.value;
                if (i.value === select.value) li.className = 'selected';
                if (idx === 0 && filter) li.classList.add('active');
                li.appendChild(flagImg(i.iso));
                var name = document.createElement('span'); name.className = 'cp-name'; name.textContent = i.name;
                var code = document.createElement('span'); code.className = 'cp-code'; code.textContent = i.value;
                li.appendChild(name); li.appendChild(code);
                li.addEventListener('click', function () { choose(i.value); });
                list.appendChild(li);
            });
        }

        function choose(value) {
            select.value = value;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            syncTrigger();
            close();
        }

        function open() {
            wrap.classList.add('open');
            trigger.setAttribute('aria-expanded', 'true');
            search.value = '';
            render('');
            setTimeout(function () { search.focus(); }, 0);
        }
        function close() {
            wrap.classList.remove('open');
            trigger.setAttribute('aria-expanded', 'false');
        }
        function toggle() { wrap.classList.contains('open') ? close() : open(); }

        trigger.addEventListener('click', function (e) { e.preventDefault(); toggle(); });
        search.addEventListener('input', function () { render(search.value); });

        // Keyboard: arrows move the highlight, Enter selects it, Esc closes.
        search.addEventListener('keydown', function (e) {
            var active = list.querySelector('li.active');
            var lis = Array.prototype.slice.call(list.querySelectorAll('li'));
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                if (!lis.length) return;
                var idx = lis.indexOf(active);
                idx = e.key === 'ArrowDown' ? Math.min(lis.length - 1, idx + 1) : Math.max(0, idx - 1);
                lis.forEach(function (l) { l.classList.remove('active'); });
                lis[idx].classList.add('active');
                lis[idx].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (active) choose(active.dataset.value);
            } else if (e.key === 'Escape') {
                close(); trigger.focus();
            }
        });

        // Close when clicking away or when the modal/select value changes elsewhere.
        document.addEventListener('click', function (e) { if (!wrap.contains(e.target)) close(); });
        select.addEventListener('change', syncTrigger);

        syncTrigger();
    }

    function init() {
        document.querySelectorAll('select[data-country-picker]').forEach(build);
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
