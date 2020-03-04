<?php
	header("Content-Type: text/html;charset=utf-8");
	echo '<head>
	<link href="generateur_syllabes.css" type="text/css" rel="stylesheet" />
	</head>';


	$_consonne = array (
		"f" => "f",
		"ph" => "ph",
		"v" => "v",
		"p" => "p",
		"b" => "b",
		"m" => "m",
		"l" => "l",
		"s" => "s",
		"ç" => "ç",
		"t" => "t",
		"d" => "d",
		"n" => "n",
		"r" => "r",
		"ch" => "ch",
		"j" => "j",
		"c" => "c",
		"qu" => "qu",
		"g" => "g",
		"gu" => "gu",
		"ge" => "ge",
		"gn" => "gn"
	);

	$_voyelle_niv_1 = array (
		"a" => "a",
		"u" => "u",
		"i" => "i",
		"o" => "o",
		"é" => "é",
		"e" => "e",
		"y" => "y"
	);

	$_voyelle_niv_2 = array (
		"ou" => "ou",
		"au" => "au",
		"eu" => "eu",
		"ai" => "ai",
		"ei" => "ei",
		"on" => "on",
		"om" => "om",
		"an" => "an",
		"en" => "en",
		"em" => "em",
		"ez" => "ez",
		"er" => "er",
		"et" => "et",
		"in" => "in",
		"im" => "im",
		"am" => "am"
	);

	$_voyelle_niv_3 = array (
		"eau" => "eau",
		"ain" => "ain",
		"aim" => "aim",
		"ein" => "ein"
	);

	$_voyelle_niv_4 = array (
		"oi" => "oi",
		"ui" => "ui",
		"ia" => "ia",
		"io" => "io",
		"iu" => "iu",
		"ié" => "ié"
	);

	$_voyelle_niv_5 = array (
		"oin" => "oin",
		"ien" => "ien",
		"ion" => "ion",
		"ian" => "ian"
	);

	function tester_syllabe ($_liste_cons, $_cons, $_liste_voy)
	{
		if($_liste_cons[$_cons] == "qu") {
			$_voy_possibles = array ("e","i","an","en");
			$_voy_id = array_rand($_voy_possibles);
			$_voy = $_voy_possibles[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "ç") {
			$_voy_id = array_rand($_liste_voy);
			while ($_liste_voy[$_voy_id][0] != "a" and $_liste_voy[$_voy_id][0] != "o" and $_liste_voy[$_voy_id][0] != "u") {
				$_voy_id = array_rand($_liste_voy);
			}
			$_voy = $_liste_voy[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "c[s]"){
			$_voy_id = array_rand($_liste_voy);
			while ($_liste_voy[$_voy_id][0] != "e" and $_liste_voy[$_voy_id][0] != "i" and $_liste_voy[$_voy_id][0] != "y") {
				$_voy_id = array_rand($_liste_voy);
			}
			$_voy = $_liste_voy[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "c[qu]"){
			$_voy_id = array_rand($_liste_voy);
			while ($_liste_voy[$_voy_id][0] != "a" and $_liste_voy[$_voy_id][0] != "o" and $_liste_voy[$_voy_id][0] != "u") {
				$_voy_id = array_rand($_liste_voy);
			}
			$_voy = $_liste_voy[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "gu") {
			$_voy_id = array_rand($_liste_voy);
			while ($_liste_voy[$_voy_id][0] != "e" and $_liste_voy[$_voy_id][0] != "i" and $_liste_voy[$_voy_id][0] != "y") {
				$_voy_id = array_rand($_liste_voy);
			}
			$_voy = $_liste_voy[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "g[gu]") {
			$_voy_id = array_rand($_liste_voy);
			while (($_liste_voy[$_voy_id][0] != "a" and $_liste_voy[$_voy_id][0] != "o" and $_liste_voy[$_voy_id][0] != "u") or $_liste_voy[$_voy_id] == "ui") {
				$_voy_id = array_rand($_liste_voy);
			}
			$_voy = $_liste_voy[$_voy_id];
		}
		elseif($_liste_cons[$_cons] == "ge") {
			$_voy_possibles = array ("a","o","ai","an","oi","on");
			$_voy_id = array_rand($_voy_possibles);
			$_voy = $_voy_possibles[$_voy_id];
		}
		else {
			$_voy_id = array_rand($_liste_voy);
			$_voy = $_liste_voy[$_voy_id];
		}
		return $_voy;
	}

	function tester_cons ($_cons) {
		if($_cons == "qu" or $_cons == "gu") {
			$_cons_testee = $_cons[0].'<span id="gris">'.'u'.'</span>';
		}
		elseif ($_cons == "c[s]") {
			$_cons_testee = "c";
		}
		elseif ($_cons == "c[qu]") {
			$_cons_testee = "c";
		}
		elseif ($_cons == "g[gu]") {
			$_cons_testee = "g";
		}
		else {
			$_cons_testee = $_cons;
		}
		return $_cons_testee;
	}

	function creer_syllabe_CV ($_liste_cons, $_liste_voy)
	{
		$_cons = array_rand($_liste_cons);
		$_voy = tester_syllabe($_liste_cons, $_cons, $_liste_voy);
		$_cons = $_liste_cons[$_cons];
		$_cons = tester_cons($_cons);
		$_syllabe = $_cons . '<span id="rouge">' . $_voy . '</span>';
		return $_syllabe;
	}

	function creer_syllabe_VC ($_liste_voy, $_liste_cons)
	{
		$_voy = array_rand($_liste_voy);
		$_cons = array_rand($_liste_cons);
		$_cons = $_liste_cons[$_cons];
		$_cons = tester_cons($_cons);
		$_syllabe = '<span id="rouge">' . $_liste_voy[$_voy] . '</span>' . $_cons;
		return $_syllabe;
	}

	function creer_syllabe_CCV ($_liste_cons_1, $_liste_cons_2, $_liste_voy)
	{
		$_cons_1 = array_rand($_liste_cons_1);
		$_cons_2 = array_rand($_liste_cons_2);
		$_voy = tester_syllabe($_liste_cons_2, $_cons_2, $_liste_voy);
		$_cons_1 = $_liste_cons_1[$_cons_1];
		$_cons_2 = $_liste_cons_2[$_cons_2];
		$_cons_1 = tester_cons($_cons_1);
		$_cons_2 = tester_cons($_cons_2);
		$_syllabe = $_cons_1 . $_cons_2 . '<span id="rouge">' . $_voy . '</span>';
		return $_syllabe;
	}

	function creer_syllabe_CVC ($_liste_cons_1, $_liste_voy, $_liste_cons_2)
	{
		$_cons_1 = array_rand($_liste_cons_1);
		$_cons_2 = array_rand($_liste_cons_2);
		$_voy = tester_syllabe($_liste_cons_1, $_cons_1, $_liste_voy);
		$_cons_1 = $_liste_cons_1[$_cons_1];
		$_cons_2 = $_liste_cons_2[$_cons_2];
		$_cons_1 = tester_cons($_cons_1);
		$_cons_2 = tester_cons($_cons_2);
		$_syllabe = $_cons_1 . '<span id="rouge">' . $_voy . '</span>' . $_cons_2;
		return $_syllabe;
	}

	function creer_syllabe_VCV ($_liste_voy, $_liste_cons)
	{
		$_voy_1 = array_rand($_liste_voy);
		$_cons = array_rand($_liste_cons);
		$_voy = tester_syllabe($_liste_cons, $_cons, $_liste_voy);
		$_cons = $_liste_cons[$_cons];
		$_cons = tester_cons($_cons);
		$_syllabe = '<span id="rouge">' . $_liste_voy[$_voy_1] . '</span>' . $_cons . '<span id="rouge">' . $_voy . '</span>';
		return $_syllabe;
	}

	function creer_tableau_syllabe_3x5 ($_code_structure, $_liste_cons_1, $_liste_voy_1, $_liste_cons_2 = null)
	{
		$_tab_syllabe = array();
		switch ($_code_structure) {
			case 0:
				for($_i=0 ; $_i < 15 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
					if($_i > 0 and $_i <=2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
						}
					}
					elseif ($_i > 2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-3]) {
							$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
						}
					}
				}
				break;
			case 1:
				for($_i=0 ; $_i < 15 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
					if($_i > 0 and $_i <=2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
						}
					}
					elseif ($_i > 2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-3]) {
							$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
						}
					}
				}
				break;
			case 2:
				for($_i=0 ; $_i < 15 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
					if($_i > 0 and $_i <=2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
						}
					}
					elseif ($_i > 2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-3]) {
							$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
						}
					}
				}
				break;
			case 3:
				for($_i=0 ; $_i < 15 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
					if($_i > 0 and $_i <=2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
						}
					}
					elseif ($_i > 2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-3]) {
							$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
						}
					}
				}
				break;
			case 4:
				for($_i=0 ; $_i < 15 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
					if($_i > 0 and $_i <=2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
						}
					}
					elseif ($_i > 2) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-3]) {
							$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
						}
					}
				}
				break;
		}

		return $_tab_syllabe;

	}

	function creer_tableau_syllabe_4x5 ($_code_structure, $_liste_cons_1, $_liste_voy_1, $_liste_cons_2 = null)
	{
		$_tab_syllabe = array();
		switch ($_code_structure) {
			case 0:
				for($_i=0 ; $_i < 20 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
					if($_i > 0 and $_i <=3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
						}
					}
					elseif ($_i > 3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-4]) {
							$_tab_syllabe[$_i] = creer_syllabe_CV($_liste_cons_1, $_liste_voy_1);
						}
					}
				}
				break;
			case 1:
				for($_i=0 ; $_i < 20 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
					if($_i > 0 and $_i <=3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
						}
					}
					elseif ($_i > 3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-4]) {
							$_tab_syllabe[$_i] = creer_syllabe_VC($_liste_voy_1, $_liste_cons_1);
						}
					}
				}
				break;
			case 2:
				for($_i=0 ; $_i < 20 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
					if($_i > 0 and $_i <=3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
						}
					}
					elseif ($_i > 3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-4]) {
							$_tab_syllabe[$_i] = creer_syllabe_CCV($_liste_cons_1, $_liste_cons_2, $_liste_voy_1);
						}
					}
				}
				break;
			case 3:
				for($_i=0 ; $_i < 20 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
					if($_i > 0 and $_i <=3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
						}
					}
					elseif ($_i > 3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-4]) {
							$_tab_syllabe[$_i] = creer_syllabe_CVC($_liste_cons_1, $_liste_voy_1, $_liste_cons_2);
						}
					}
				}
				break;
			case 4:
				for($_i=0 ; $_i < 20 ; $_i++) {
					$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
					if($_i > 0 and $_i <=3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1]) {
							$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
						}
					}
					elseif ($_i > 3) {
						while ($_tab_syllabe[$_i] == $_tab_syllabe[$_i - 1] or $_tab_syllabe[$_i] == $_tab_syllabe[$_i-4]) {
							$_tab_syllabe[$_i] = creer_syllabe_VCV($_liste_voy_1, $_liste_cons_1);
						}
					}
				}
				break;
		}

		return $_tab_syllabe;
	}

	function afficher_tableau_syllabe_3x5 ($_liste_syllabes)
	{
		echo
		'<table style="width:100%;" id="tab_consonne">
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[0],'</td>
			<td id="td_consonne">',$_liste_syllabes[1],'</td>
			<td id="td_consonne">',$_liste_syllabes[2],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[3],'</td>
			<td id="td_consonne">',$_liste_syllabes[4],'</td>
			<td id="td_consonne">',$_liste_syllabes[5],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[6],'</td>
			<td id="td_consonne">',$_liste_syllabes[7],'</td>
			<td id="td_consonne">',$_liste_syllabes[8],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[9],'</td>
			<td id="td_consonne">',$_liste_syllabes[10],'</td>
			<td id="td_consonne">',$_liste_syllabes[11],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[12],'</td>
			<td id="td_consonne">',$_liste_syllabes[13],'</td>
			<td id="td_consonne">',$_liste_syllabes[14],'</td>
		</tr>

		</table>';
	}

	function afficher_tableau_syllabe_4x5 ($_liste_syllabes)
	{
		echo
		'<table style="width:100%;" id="tab_consonne">
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[0],'</td>
			<td id="td_consonne">',$_liste_syllabes[1],'</td>
			<td id="td_consonne">',$_liste_syllabes[2],'</td>
			<td id="td_consonne">',$_liste_syllabes[3],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[4],'</td>
			<td id="td_consonne">',$_liste_syllabes[5],'</td>
			<td id="td_consonne">',$_liste_syllabes[6],'</td>
			<td id="td_consonne">',$_liste_syllabes[7],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[8],'</td>
			<td id="td_consonne">',$_liste_syllabes[9],'</td>
			<td id="td_consonne">',$_liste_syllabes[10],'</td>
			<td id="td_consonne">',$_liste_syllabes[11],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[12],'</td>
			<td id="td_consonne">',$_liste_syllabes[13],'</td>
			<td id="td_consonne">',$_liste_syllabes[14],'</td>
			<td id="td_consonne">',$_liste_syllabes[15],'</td>
		</tr>
		<tr id="tr_consonne">
			<td id="td_consonne">',$_liste_syllabes[16],'</td>
			<td id="td_consonne">',$_liste_syllabes[17],'</td>
			<td id="td_consonne">',$_liste_syllabes[18],'</td>
			<td id="td_consonne">',$_liste_syllabes[19],'</td>
		</tr>

		</table>';
	}

	$_liste_consonne_1 = array();
	$_liste_consonne_2 = array();
	$_liste_voy = array();
	$_structure = null;
	$_taille = null;

	$_structure = isset($_POST['structure']) ? $_POST['structure'] : NULL;
	$_taille = isset($_POST['taille']) ? $_POST['taille'] : NULL;
	$_couleur_voy = isset($_POST['couleur_voy']) ? $_POST['couleur_voy'] : NULL;

	$_liste_consonne_1 = isset($_POST['consonne_1']) ? $_POST['consonne_1'] : NULL;
	$_liste_consonne_2 = isset($_POST['consonne_2']) ? $_POST['consonne_2'] : NULL;
	$_liste_voy = isset($_POST['liste_voy']) ? $_POST['liste_voy'] : NULL;

	$_liste_syllabes = array();

	if($_couleur_voy == "rouge") {
		echo '<style type="text/css"> #rouge{color: red;} #gris{color:grey;} </style>';
	}
	else {
		echo '<style type="text/css"> #rouge{color: black;} #gris{color:black;}</style>';
	}

	if($_taille == "18") {
		$_liste_syllabes = creer_tableau_syllabe_3x5($_structure, $_liste_consonne_1, $_liste_voy, $_liste_consonne_2);
		afficher_tableau_syllabe_3x5($_liste_syllabes);
		echo '<button class="bouton_imprimer" onclick="window.print()">Imprimer</button> ';
	}
	else {
		$_liste_syllabes = creer_tableau_syllabe_4x5($_structure, $_liste_consonne_1, $_liste_voy, $_liste_consonne_2);
		afficher_tableau_syllabe_4x5($_liste_syllabes);
		echo '<button class="bouton_imprimer" onclick="window.print()">Imprimer</button> ';
	}
?>
