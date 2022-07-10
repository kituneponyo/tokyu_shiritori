<?php

ini_set('max_execution_time', 300);

$stations = [
	'青葉台' => 'あおばだい',
	'あざみ野' => 'あざみの',
	'池上' => 'いけがみ',
	'池尻大橋' => 'いけじりおおはし',
	'石川台' => 'いしかわだい',
	'市が尾' => 'いちがお',
	'鵜の木' => 'うのき',
	'江田' => 'えだ',
	'荏原中延' => 'えばらなかのぶ',
	'荏原町' => 'えばらちょう',
	'大井町' => 'おおいまち',
	'大岡山' => 'おおおかやま',
	'大倉山' => 'おおくらやま',
	'大崎広小路' => 'おおさかひろこうじ',
	'奥沢' => 'おくざわ',
	'尾山台' => 'おやまだい',
	'恩田' => 'おんだ',
	'御嶽山' => 'おんたけやま',
	'学芸大学' => 'がくげいだいがく',
	'梶が谷' => 'かじがや',
	'蒲田' => 'かまた',
	'上野毛' => 'かみのげ',
	'上町' => 'かみまち',
	'菊名' => 'きくな',
	'北千束' => 'きたちづか',
	'久が原' => 'くがはら',
	'九品仏' => 'くほんぶつ',
	'五反田' => 'ごたんだ',
	'こどもの国' => 'こどものくに',
	'駒沢大学' => 'こまざわだいがく',
	'鷺沼' => 'さぎぬま',
	'桜新町' => 'さくらしんまち',
	'三軒茶屋' => 'さんげんちゃや',
	'渋谷' => 'しぶや',
	'下神明' => 'しもしんめい',
	'下高井戸' => 'しもたかいど',
	'下丸子' => 'しもまるこ',
	'自由が丘' => 'じゆうがおか',
	'松陰神社前' => 'しょういんじんじゃまえ',
	'新丸子' => 'しんまるこ',
	'すずかけ台' => 'すずかけだい',
	'世田谷' => 'せたがや',
	'洗足' => 'せんぞく',
	'洗足池' => 'せんぞくいけ',
	'代官山' => 'だいかんやま',
	'高津' => 'こうづ',
	'田奈' => 'たな',
	'多摩川' => 'たまがわ',
	'たまプラーザ' => 'たまぷらーざ',
	'反町' => 'たんまち',
	'千鳥町' => 'ちどりちょう',
	'中央林間' => 'ちゅうおうりんかん',
	'つきみ野' => 'つきみの',
	'つくし野' => 'つくしの',
	'綱島' => 'あみしま',
	'田園調布' => 'でんえんちょうふ',
	'戸越銀座' => 'とごしぎんざ',
	'戸越公園' => 'とごしこうえん',
	'等々力' => 'とどろき',
	'都立大学' => 'とりつだいがく',
	'長津田' => 'ながつた',
	'中延' => 'なかのぶ',
	'長原' => 'ながはら',
	'中目黒' => 'なかめぐろ',
	'西小山' => 'にしこやま',
	'西太子堂' => 'にしたいしどう',
	'沼部' => 'ぬまべ',
	'白楽' => 'はくらく',
	'蓮沼' => 'はすぬま',
	'旗の台' => 'はたのだい',
	'東白楽' => 'ひがしはくらく',
	'日吉' => 'ひよし',
	'藤が丘' => 'ふじがおか',
	'二子新地' => 'ふたこしんち',
	'二子玉川' => 'ふたこたまがわ',
	'不動前' => 'ふどうまえ',
	'松原' => 'まつばら',
	'溝の口' => 'みぞのくち',
	'緑が丘' => 'みどりがおか',
	'南町田グランベリーパーク' => 'みなみまちだぐらんべりーぱーく',
	'宮崎台' => 'みやざきだい',
	'宮の坂' => 'みやのさか',
	'宮前平' => 'みやまえだい',
	'妙蓮寺' => 'みょうれんじ',
	'武蔵小杉' => 'むさしこすぎ',
	'武蔵小山' => 'むさしこやま',
	'武蔵新田' => 'むさししんでん',
	'目黒' => 'めぐろ',
	'元住吉' => 'もとすみよし',
	'矢口渡' => 'やぐちのわたし',
	'山下' => 'やました',
	'祐天寺' => 'ゆうてんじ',
	'雪が谷大塚' => 'ゆきがやおおつか',
	'用賀' => 'ようが',
	'横浜' => 'よこはま',
	'若林' => 'わかばやし'
];

$longest = 0;

$result = [];
$nest = 0;
foreach ($stations as $key => $station) {
	//print $nest . " => " . $station . "<br>\n";
	$_stations = $stations;
	unset($_stations[$key]);
	$result[$station] = getNextStation($nest + 1, $_stations, $station);
}

print_tree($result, 0);

print "end";


function getNextStation ($nest, $stations, $station) {

	global $longest;

	if ($nest > $longest) {
		$longest = $nest;
	}

	$results = [];
	$lastChar = mb_substr($station, -1, 1, 'UTF-8');
	foreach ($stations as $key => $nextStation) {
		if ($station == $nextStation) {
			continue;
		}
		$firstChar = mb_substr($nextStation, 0, 1, 'UTF-8');
		if ($lastChar == $firstChar) {
			if ($longest == $nest) {
				//print str_repeat("&nbsp;", $nest) . $nest . " => " . $nextStation . "<br>\n";
			}
			$_stations = $stations;
			unset($_stations[$key]);
			$results[$nextStation] = getNextStation($nest + 1, $_stations, $nextStation);
		}
	}

	// 剪定
	$maxDepth = 0;
	if (count($results) > 1) {
		foreach ($results as $result) {
			$depth = array_depth($result);
			if ($depth > $maxDepth) {
				$maxDepth = $depth;
			}
		}
		foreach ($results as $key => $result) {
			$depth = array_depth($result);
			if ($maxDepth > $depth) {
				unset($results[$key]);
			}
		}
	}

	return $results;
}

function array_depth($a, $c = 0)
{
  return (is_array($a) && count($a))
        ? max(array_map("array_depth", $a, array_fill(0, count($a), ++$c)))
        : $c;
}

function print_tree ($tree, $depth) {
	foreach ($tree as $station => $_tree) {
		print str_repeat("&nbsp;", $depth) . " " . $depth . " => " . $station . "<br>\n";
		print_tree($_tree, $depth + 1);
	}
}




