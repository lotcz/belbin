insert into belbin_roles (belbin_role_name) values ('Inovátor');
insert into belbin_roles (belbin_role_name) values ('Všudybyl, vyhledavač');
insert into belbin_roles (belbin_role_name) values ('Koordinátor');
insert into belbin_roles (belbin_role_name) values ('Formovač');
insert into belbin_roles (belbin_role_name) values ('Analytik');
insert into belbin_roles (belbin_role_name) values ('Stmelovač');
insert into belbin_roles (belbin_role_name) values ('Realizátor');
insert into belbin_roles (belbin_role_name) values ('Dotahovač');
insert into belbin_roles (belbin_role_name) values ('Specialista');
insert into belbin_roles (belbin_role_name) values ('Neutr. body');

insert into belbin_questions (belbin_question_index, belbin_question_text) values (1, 'Čím mohu být prospěšný:');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (2, 'Kdybych měl nedostatky v týmové práci, byly by to nejspíše:');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (3, 'Když spolupracuji na nějakém projektu s jinými lidmi:');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (4, 'Můj charakteristický přístup ke skupinové práci je, že:');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (5, 'Práce mě těší, protože');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (6, 'Když dostanu obtížný úkol, který je nutno splnit v omezeném čase a s neznámými lidmi');
insert into belbin_questions (belbin_question_index, belbin_question_text) values (7, 'Ve vztahu k problémům, v nichž jsem zaangažován, při práci ve skupině');
 
/* I. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 1, 'Myslím, že si dokážu rychle všimnout nových příležitostí a včas jich využít.', 2); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 2, 'Mé názory na všeobecné i speciální otázky jsou dobře přijímány.', 10);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 3, 'Mohu dobře spolupracovat s velmi širokým okruhem lidí.', 6);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 4, 'Velmi snadno a přirozeně přicházím na nové myšlenky a nápady.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 5, 'Dokážu vyhecovat lidi k činnosti, kdykoli zjistím, že mohou něčím cenným přispět k skupinovým cílům.', 3);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 6, 'Spolehlivě dokončím úkoly, které jsem přijal.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 7, 'Odborné, technické znalosti a zkušenosti jsou mým hlavním kladem.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 8, 'Dokážu čelit dočasné neoblíbenosti, jestliže to nakonec vede k dobrým výsledkům.', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 9, 'Rychle vycítím, zda je plán reálný a co se má dělat v situaci, kterou znám.', 7);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (1, 10, 'Dovedu bez předsudků a zaujatosti navrhnout rozumné alternativní řešení.', 5);

/* II. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 1, 'Necítím se dobře, pokud jednání nemá jasnou strukturu a není dobře vedeno.', 7); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 2, 'Mám tendenci být příliš velkorysý k lidem, kteří zastávají opodstatněné stanovisko, jemuž nebyla věnována náležitá pozornost.', 3);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 3, 'Odmítám se vyslovit, pokud projednávaná záležitost není z oblasti, kterou dobře znám.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 4, 'Mám tendenci mluvit příliš mnoho, když se skupina dostane k novým myšlenkám.', 2);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 5, 'Mám sklon podceňovat svůj vlastní přínos.', 10);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 6, 'Můj objektivní náhled mi neumožňuje sdílet nadšení ostatních.', 5);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 7, 'Někdy se jevím jako příliš energický a autoritářský, když je potřeba něco dodělat.', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 8, 'Je pro mě těžké vystupovat ve vedoucí roli, protože jsem citlivý na atmosféru ve skupině.', 6);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 9, 'Stává se mi, že se tak ponořím do svých myšlenek, že ztratím ponětí o tom, co se děje.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (2, 10, 'Odmítám se vyjádřit k názorům a návrhům, které jsou nekompletní a málo podrobné.', 8);

/* III. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 1, 'Mám schopnost lidi ovlivnit, aniž bych je k něčemu nutil.', 3); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 2, 'Moje bdělost umožňuje předcházet omylům a chybám z nepozornosti.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 3, 'Jsem připraven tlačit ostatní do činnosti, aby se na jednání neztrácel čas a zřetel na hlavní cíl (neodbočovalo se od tématu).', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 4, 'Dá se počítat s tím, že přispěji něčím originálním.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 5, 'Jsem vždycky připraven hájit dobrý návrh ve společném zájmu.', 6);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 6, 'Každý si může být jist, že zůstanu sám sebou.', 10);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 7, 'Jsem blázen do nových myšlenek a posledních vývojových novinek, rychle rozeznám novou příležitost.', 2);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 8, 'Snažím se zachovat smysl pro profesionalitu.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 9, 'Věřím, že ostatní oceňují mou schopnost chladného úsudku a správných rozhodnutí.', 5);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (3, 10, 'Je na mě spolehnutí, že dohlédnu na to, aby se udělalo co je potřeba, vnáším organizovaný přístup do řešení problému.', 7);

/* IV. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 1, 'Mám zájem poznat lépe své kolegy.', 6); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 2, 'Přispěji tam, kde vím, o čem hovořím.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 3, 'Nezdráhám se odmítnout názory druhých a zastávat sám menšinové stanovisko.', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 4, 'Obvykle najdu řadu argumentů vyvracejících nesmyslné návrhy.', 5);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 5, 'Dokážu uvést věci do chodu, když je třeba plán začít uskutečňovat.', 7);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 6, 'Mám tendenci vyhýbat se obvyklým věcem a přicházet s něčím nečekaným.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 7, 'Snažím se vnést náznak dokonalosti do každé týmové práce, na níž se podílím.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 8, 'Rád zajišťuji kontakty mimo skupinu a mimo firmu.', 2);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 9, 'Zajímají mě sociální stránky pracovních vztahů.', 10);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (4, 10, 'Při rozhodování mám zájem slyšet všechny názory a bez obtíží se přizpůsobím, když už se musí rozhodnout.', 3);

/* V. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 1, 'Baví mě analyzovat situace a zvažovat všechny varianty.', 5); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 2, 'Rád nalézám praktická řešení problémů.', 7);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 3, 'Rád podporuji dobré pracovní vztahy.', 6);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 4, 'Mohu uplatnit svůj silný vliv na rozhodování.', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 5, 'Mám příležitost setkávat se s novými lidmi, kteří mi mohou poskytnout novou zkušenost.', 2);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 6, 'Dokážu sjednotit názory lidí, jejich priority a vést je ke společným cílům.', 3);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 7, 'Jsem ve svém živlu, když se mohu s plným nasazením věnovat nějakému úkolu.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 8, 'Rád mám věci, které napínají moji představivost.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 9, 'Velmi výhodně využívám svou speciální kvalifikaci a praxi.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (5, 10, 'Práce mi dává příležitost pro seberealizaci.', 10);

/* VI. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 1, 'Obyčejně jsem úspěšný bez ohledu na okolnosti.', 10); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 2, 'Rád si o problému přečtu tolik, kolik je vhodné.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 3, 'Sedl bych si někam do kouta, přemýšlel, abych nalezl vlastní řešení a pak se pokusil se ho prodat skupině.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 4, 'Byl bych ochoten pracovat s člověkem, který projevuje nejpozitivnější přístup bez ohledu na to, jak těžko snesitelný může být.', 6);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 5, 'Hledal bych způsob zmenšení složitosti úkolu stanovením toho, čím mohou různí jednotlivci nejlépe přispět.', 3);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 6, 'Můj přirozený cit pro povinnost by přispěl k tomu, že dodržíme harmonogram.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 7, 'Věřím, že bych zůstal klidný a udržel si schopnost racionálního myšlení.', 5);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 8, 'Držel bych se stále účelu a prosazoval vše, co musí být uděláno, navzdory tlakům.', 7);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 9, 'Byl bych připraven se ujmout vedení, kdybych cítil, že se skupina nehýbá kupředu.', 4);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (6, 10, 'Zahájil bych rozhovory a jednání se záměrem stimulovat nové myšlenky a uvést věci do pohybu.', 2);

/* VII. */
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 1, 'Mám sklon projevovat netrpělivost s těmi, kdo zdržují postup a rázně reagovat.', 4); 
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 2, 'Ostatní mě mohou kritizovat za to, že jsem příliš analytický a nepříliš citlivý.', 5);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 3, 'Moje potřeba ujistit se, kontrolovat, že práce je udělaná dobře, není vždy vítaná.', 8);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 4, 'Snadno se začnu nudit, pokud nemohu účinně stimulovat k akci ostatní.', 2);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 5, 'Je pro mě obtížné začít, dokud není cíl jasný.', 7);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 6, 'Někdy se mi nedaří vysvětlovat a objasňovat složité myšlenky, které mě napadají.', 1);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 7, 'Jsem si vědom toho, že požaduji od ostatních věci, které sám nedovedu nebo nemohu udělat.', 3);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 8, 'Myslím si, že mi ostatní dávají prostor pro to, abych se vyjádřil.', 10);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 9, 'Často mám pocit, že ztrácím čas a že bych to sám udělal lépe.', 9);
insert into belbin_answers (belbin_answer_question_id, belbin_answer_index, belbin_answer_text, belbin_answer_role_id) values (7, 10, 'Váhám se postavit za svůj názor, vyjádřit jej před lidmi, kteří mají moc nebo s kterými se obtížně vychází.', 6);


select * from belbin_answers
order by belbin_answer_question_id, belbin_answer_index;

select belbin_answer_question_id, belbin_answer_role_id, count(*) from belbin_answers
group by belbin_answer_question_id, belbin_answer_role_id;