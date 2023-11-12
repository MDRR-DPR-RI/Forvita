var possible_map_input = {
    path01: ['aceh', 'ac', 'ach', 'ache', 'ace', 'aech', 'aseh', 'acah', 'acch', 'acey', 'aceg', 'aveh', 'acfh', 'acej'],
    path02: ['sumaterautara', 'sumut', 'sumateratarah', 'sumateratara', 'sumateratarta', 'sumateraturra', 'sumaterutara', 'sumateratar', 'sumateratrra', 'sumaterautra', 'sumateruatara', 'sumaterautrara'],
    path03: ['sumaterabarat', 'sumbar', 'sumaterbarat', 'sumaterabarta', 'sumateraabarat', 'sumaterabarrat', 'sumaterbarata', 'sumaterabart', 'sumaterabaratr', 'sumaterabatrat', 'sumaterbaratara', 'sumaterabarrata'],
    path04: ['riau', 'ri', 'ria', 'riay', 'riaw', 'rjau', 'rai', 'riaa', 'riai', 'riak', 'roau', 'riua'],
    path05: ['jambi', 'ja', 'jamb', 'jambia', 'jambu', 'jaambi', 'jambii', 'jamby', 'jambk', 'jambiia', 'jambl', 'jambri'],
    path06: ['sumateraselatan', 'sumsel', 'sumateraslatan', 'sumateraselatann', 'sumateraselata', 'sumaterasaelatan', 'sumateraslatn', 'sumateraselat', 'sumaterasltan', 'sumateraselataan', 'sumateraselatana', 'sumaterasselatan'],
    path07: ['bengkulu', 'be', 'bengkul', 'bengkull', 'bengkulua', 'bengkuluu', 'bengkuluul', 'bengkuluu', 'bengkuluv', 'bengkuluuu', 'bengkuluul', 'bengkuluur'],
    path08: ['lampung', 'la', 'lampong', 'lamupng', 'lampun', 'lamupang', 'lamupung', 'lmpung', 'llampung', 'lampunng', 'lamupangg', 'lampungg'],
    path09: ['kep.bangkabelitung', 'kep.babel', 'bangkabelitung', 'babel', 'bangkabelitunng', 'bangkabeliitung', 'bangkabelitug', 'bangkabeliitungg', 'bangkabelitnug', 'bangkabeitung', 'bangkabelitnugg', 'bangkabelitun', 'bangkabelitumg', 'bangkabelittung'],
    path10: ['kepulauanriau','kep.kepulauanriau', 'kep.riau', 'kepri', 'kepulauanria', 'kepulauanriay', 'kepulauanriaw', 'kepulauanjriau', 'kepulauanrai', 'kepulauanriaa', 'kepulauanriai', 'kepulauanriak', 'kepulauanroau', 'kepulauanriua'],
    path11: ['jakarta', 'dkijakarta', 'dkijkt', 'dki', 'jakrta', 'jakartaa', 'jaakarta', 'jakartat', 'jkaarta', 'jakata', 'jakarat', 'jakatra', 'djikarta', 'jakart'],
    path12: ['jawabarat', 'jabar', 'jawabarat', 'jawbar', 'jwabarat', 'jawabrata', 'jwabarrat', 'jwabaraat', 'jawabart', 'jawabbarat', 'jawabratt', 'jawabrataa', 'jawabrta', 'jawabaratt'],
    path13: ['jawatengah', 'jateng', 'jawatenga', 'jawatengahh', 'jawatenggah', 'jawatengaha', 'jawateengah', 'jawatengahg', 'jawateenggah', 'jawatengahj', 'jawatengaha', 'jawatengahn'],
    path14: ['banten', 'bt', 'bantn', 'baten', 'bantenn', 'batenn', 'batennn', 'bantenm', 'bantten', 'banttenn', 'banteen', 'bantn'],
    path15: ['jawatimur', 'jatim', 'jawatimurr', 'jawatimr', 'jawatimura', 'jawatimmur', 'jawatimu', 'jawattimur', 'jawatimuurr', 'jawatimuhr', 'jawatimuara', 'jawatimuur'],
    path16: ['yogyakarta', 'jogja', 'diy', 'yogyarta', 'yogyakartaa', 'yogyakrta', 'yogyakat', 'yogjakarta', 'yogyakart', 'yogyakrata', 'yogyaakarta', 'yogyakarrta', 'yogyakartta'],
    path17: ['bali', 'ba', 'baali', 'baii', 'bbali', 'baalii', 'balii', 'bvali', 'baliu', 'balli', 'baili', 'bali'],
    path18: ['nusatenggarabarat', 'ntb', 'nusatenggarabratt', 'nusatenggarabaat', 'nusatenggarabrata', 'nusatengarabarat', 'nusatenggarbaraat', 'nusatenggbarabarat', 'nusatenggaraabarat', 'nusatenggarabraat', 'nusatenggarrabarat', 'nusatenggarabaraat'],
    path19: ['nusatenggaratimur', 'ntt', 'nusatenggaraatimur', 'nusatenggaratmiur', 'nusatenggaratimurr', 'nusatenggaratiumr', 'nusatenggaratimru', 'nusatenggaratiumur', 'nusatenggaratimmur', 'nusatenggaraatimuur', 'nusatenggaraatimurr', 'nusatenggaratimurr'],
    path20: ['kalimantanbarat', 'kalbar', 'kalimantanbaraat', 'kalimantanbaratt', 'kalimantanbaratata', 'kalimantanbaratg', 'kalimantanbarar', 'kalimantabaratt', 'kalimantbanarat', 'kalimantbarat', 'kalimantanbarart', 'kalimantanbarata'],
    path21: ['kalimantantengah', 'kalteng', 'kalimantantengahh', 'kalimantantenggah', 'kalimantantegah', 'kalimantatengah', 'kalimantantengaha', 'kalimantantengh', 'kalimantantenggh', 'kalimantentengah', 'kalimantatenggah', 'kalimantanetngah'],
    path22: ['kalimantanselatan', 'kalsel', 'kalimantanselatann', 'kalimantanselaatan', 'kalimantanselattaan', 'kalimantanselattan', 'kalimantanselatn', 'kalimantanselattan', 'kalimantanseltan', 'kalimantanselatann', 'kalimantanselatn', 'kalimantanselattann'],
    path23: ['kalimantantimur', 'kaltim', 'kalimantantimurr', 'kalimanttimur', 'kalimantanitmur', 'kalimantantimurr', 'kalimantantmiur', 'kalimantantimr', 'kalimantantimurr', 'kalimantatimur', 'kalimantantimumr', 'kalimantatimurr'],
    path24: ['kalimantanutara', 'kalut', 'kalimantanutar', 'kalimantanutarra', 'kalimantanutaraa', 'kalimantannutara', 'kalimantanutrar', 'kalimantanutara', 'kalimantnutara', 'kalimantanutarraa', 'kalimantanutarr', 'kalimantannutara'],
    path25:['sulawesiutara', 'sulut', 'sulawesiutarra', 'sulawesiutarat', 'sulawesiutrra', 'sulawesiutaraa', 'sulawesiutar', 'sulawesiutarr', 'sulawesitara', 'sulawesiutrat', 'sulawesitaraa', 'sulawesutarat'],
    path26: ['sulawesitengah', 'sulteng', 'sulawesitengahh', 'sulawesitengaah', 'sulawesitenggah', 'sulawesitenggaha', 'sulawesitenggahaa', 'sulawesitenggha', 'sulawesitengh', 'sulawesitenggahaa', 'sulawesitengaha', 'sulawesitenggahaa'],
    path27: ['sulawesiselatan', 'sulsel', 'sulawesiselatann', 'sulawesiselataan', 'sulawesiselattan', 'sulawesiselattann', 'sulawesiselatn', 'sulawesiselattaan', 'sulawesiseltan', 'sulawesiselatann', 'sulawesiselattan', 'sulawesiselatta'],
    path28: ['sulawesitenggara', 'sultra', 'sulawesitenggaraa', 'sulawesitenggaraat', 'sulawesitenggarr', 'sulawesitenggaratt', 'sulawesitenggarra', 'sulawesitengara', 'sulawesitenggara', 'sulawesitenggaraat', 'sulawesitenggarrat', 'sulawesitenggarat'],
    path29: ['gorontalo', 'go', 'gorontaloo', 'gorontal', 'gorontaalo', 'goronttalo', 'gorontaloo', 'gorntalo', 'goronntalo', 'goronttlo', 'gorontaloo', 'goronttal',],
    path30:  ['sulawesibarat', 'sulbar', 'sulawesibaraatt', 'sulawesibart', 'sulawesibartaa', 'sulawesibaratt', 'sulawesibarattt', 'sulawesibarattt', 'sulawesibaratg', 'sulawesibarar', 'sulawesibaratata', 'sulawesibarat'],
    path31: ['maluku', 'ma', 'malku', 'malukuu', 'maluk', 'malukku', 'malukuu', 'mauku', 'maluuk', 'maluku', 'malukkuu', 'maluuku'],
    path32: ['malukuutara', 'malut', 'malu', 'malutu', 'maluut', 'maut', 'maluutt', 'malutuu', 'maluu', 'mautu', 'maluuut', 'malukut'],
    path33: ['papua', 'ppua', 'papuua', 'papuas', 'papuaa', 'ppaua', 'paua', 'papau', 'ppua', 'papa', 'papuaa', 'pppua'],
    path34: ['papuabarat', 'pabar', 'pabara', 'pabarata', 'pabaratr', 'pabaratat', 'pabuart', 'papuart', 'pabarat', 'pabaratt', 'pabarrat', 'pabaratt'],
};