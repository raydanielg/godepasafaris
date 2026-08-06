{{-- Shared country-code options for the booking/inquiry phone fields.
     Tanzania first (the primary market). Each option carries:
       - value    : the dialling code actually submitted (name="phone_country_code")
       - data-iso : ISO-3166 alpha-2, used to build the flag image URL
       - data-name: plain country name, used for type-to-search
     The visible text stays readable as a no-JS fallback; JavaScript in
     partials/scripts.blade.php upgrades this <select> into a searchable,
     flag-equipped dropdown (see [data-country-picker]). --}}
<option value="+255" data-iso="tz" data-name="Tanzania" selected>Tanzania (+255)</option>
<option value="+254" data-iso="ke" data-name="Kenya">Kenya (+254)</option>
<option value="+256" data-iso="ug" data-name="Uganda">Uganda (+256)</option>
<option value="+250" data-iso="rw" data-name="Rwanda">Rwanda (+250)</option>
<option value="+27" data-iso="za" data-name="South Africa">South Africa (+27)</option>
<option value="+251" data-iso="et" data-name="Ethiopia">Ethiopia (+251)</option>
<option value="+260" data-iso="zm" data-name="Zambia">Zambia (+260)</option>
<option value="+263" data-iso="zw" data-name="Zimbabwe">Zimbabwe (+263)</option>
<option value="+267" data-iso="bw" data-name="Botswana">Botswana (+267)</option>
<option value="+264" data-iso="na" data-name="Namibia">Namibia (+264)</option>
<option value="+234" data-iso="ng" data-name="Nigeria">Nigeria (+234)</option>
<option value="+233" data-iso="gh" data-name="Ghana">Ghana (+233)</option>
<option value="+20" data-iso="eg" data-name="Egypt">Egypt (+20)</option>
<option value="+1" data-iso="us" data-name="USA / Canada">USA / Canada (+1)</option>
<option value="+44" data-iso="gb" data-name="United Kingdom">United Kingdom (+44)</option>
<option value="+49" data-iso="de" data-name="Germany">Germany (+49)</option>
<option value="+33" data-iso="fr" data-name="France">France (+33)</option>
<option value="+39" data-iso="it" data-name="Italy">Italy (+39)</option>
<option value="+34" data-iso="es" data-name="Spain">Spain (+34)</option>
<option value="+31" data-iso="nl" data-name="Netherlands">Netherlands (+31)</option>
<option value="+32" data-iso="be" data-name="Belgium">Belgium (+32)</option>
<option value="+41" data-iso="ch" data-name="Switzerland">Switzerland (+41)</option>
<option value="+46" data-iso="se" data-name="Sweden">Sweden (+46)</option>
<option value="+47" data-iso="no" data-name="Norway">Norway (+47)</option>
<option value="+45" data-iso="dk" data-name="Denmark">Denmark (+45)</option>
<option value="+353" data-iso="ie" data-name="Ireland">Ireland (+353)</option>
<option value="+351" data-iso="pt" data-name="Portugal">Portugal (+351)</option>
<option value="+48" data-iso="pl" data-name="Poland">Poland (+48)</option>
<option value="+61" data-iso="au" data-name="Australia">Australia (+61)</option>
<option value="+64" data-iso="nz" data-name="New Zealand">New Zealand (+64)</option>
<option value="+91" data-iso="in" data-name="India">India (+91)</option>
<option value="+86" data-iso="cn" data-name="China">China (+86)</option>
<option value="+81" data-iso="jp" data-name="Japan">Japan (+81)</option>
<option value="+82" data-iso="kr" data-name="South Korea">South Korea (+82)</option>
<option value="+65" data-iso="sg" data-name="Singapore">Singapore (+65)</option>
<option value="+971" data-iso="ae" data-name="United Arab Emirates">UAE (+971)</option>
<option value="+966" data-iso="sa" data-name="Saudi Arabia">Saudi Arabia (+966)</option>
<option value="+974" data-iso="qa" data-name="Qatar">Qatar (+974)</option>
<option value="+972" data-iso="il" data-name="Israel">Israel (+972)</option>
<option value="+55" data-iso="br" data-name="Brazil">Brazil (+55)</option>
<option value="+52" data-iso="mx" data-name="Mexico">Mexico (+52)</option>
<option value="+7" data-iso="ru" data-name="Russia">Russia (+7)</option>
