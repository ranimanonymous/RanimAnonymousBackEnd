<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class IR extends Model
{

    public static function indexingText($text){
        $wordList = self::getListOfWord($text);
        $returnedArr = [];
        $indexedArr = [];

        foreach ($wordList as $word){
            $indexedOfOneWordArr = self::indexingWord($word);
//            dd($word);
//            dd($indexedOfOneWordArr);
            foreach ($indexedOfOneWordArr as $item){
                array_push($returnedArr, $item);
                array_push($indexedArr, $item);
            }
            array_push($returnedArr, $word);
        }

//        $returnedArr = self::weightingWords($returnedArr, $wordList);

//        $returnedArr = array_slice($returnedArr, 0, $CountOfReturnedWords);

//        dd($returnedArr);
        return $returnedArr;
    }

    public static function indexingWord($word){

        $wordList = [];

        array_push($wordList, self::soundWord($word));
        $wordList = self::ngram($wordList, $word);
        $wordList = array_diff($wordList, [$word]);

        return $wordList;
    }

    public static function getListOfWord($input){

        $commonWords = array(
            '\ \.','\ \.\N','\ \.\ ',
//            'A','ABLE','ABOUT','ABOVE','ABROAD','ACCORDING',
//            'ACCORDINGLY','ACROSS','ACTUALLY','ADJ','ADD','ADDED','AFTER','AFTERWARDS','AGAIN',
//            'AGAINST','AGO','AHEAD','AIN\'T','ALL','ALLOW','ALLOWS','ALMOST',
//            'ALONE','ALONG','ALONGSIDE','ALREADY','ALSO','ALTHOUGH','ALWAYS',
//            'AM','AMID','AMIDST','AMONG','AMONGST','AN','AND','ANOTHER','ANY',
//            'ANYBODY','ANYHOW','ANYONE','ANYTHING','ANYWAY','ANYWAYS','ANYWHERE',
//            'APART','APPEAR','APPRECIATE','APPROPRIATE','ARE','AREN\'T','AROUND',
//            'AS','A\'S','ASIDE','ASK','ASKED','ASKING','ASSOCIATED','AT','AVAILABLE',
//            'AWAY','AWFULLY','B','BACK','BAD','BACKWARD','BACKWARDS','BE','BECAME',
//            'BECAUSE','BECOME','BECAME','BECOMES','BECOMING','BEEN','BEFORE','BEFOREHAND',
//            'BEGIN','BEGAN','BEHIND','BEING','BELIEVE','BELOW','BESIDE','BESIDES','BEST',
//            'BETTER','BETWEEN','BEYOND','BIG','BIGGEST','BOTH','BROUGHT','BRIEF','BUT','BY','C','CALLED','CAME','CAN',
//            'CANNOT','CANT','CAN\'T','CENT','COMPLETE','CONTINUE','CAPTION','CAUSE','CAUSES','CERTAIN','CERTAINLY',
//            'CHANGES','CLEARLY','C\'MON','CO','COME','COMES','CONCERNING',
//            'CONSEQUENTLY','CONSIDER','CONSIDERING','CONTAIN','CONTAINING','CONTAINS',
//            'CORRESPONDING','COULD','COULDN\'T','COURSE','C\'S','CURRENTLY','D','DAY','DECIDED','DECIDE',
//            'DECLARED','DECLARE','DARE',
//            'DAREN\'T','DEFINITELY','DESCRIBED','DESPITE','DID','DIDN\'T','DIFFERENT',
//            'DIRECTLY','DO','DOES','DOESN\'T','DOING','DONE','DON\'T','DOWN','DOWNWARDS',
//            'DURING','E','EACH','EARLY','EDU','EP','EG','EIGHT','EIGHTY','EITHER','ELSE','ELSEWHERE',
//            'END','ENDING','ENOUGH','ENTIRE','ENTIRELY','ESPECIALLY','ET','ETC','EVEN','EVER',
//            'EVERMORE','EVERY','EVERYBODY','EVERYONE','EVERYTHING','EVERYWHERE','EX',
//            'EXACTLY','EXAMPLE','EXCEPT','F','FACE','FACED','FELL','FACT','FAIRLY','FAR','FINALLY','FIND','FARTHER','FEW','FEWER',
//            'FIFTH','FIRST','FIVE','FOLLOWED','FOLLOWING','FOLLOWS','FAIL','FAILED','FOR','FOREVER',
//            'FORMER','FORMERLY','FORTH','FORWARD','FOUND','FOUR','FROM','FURTHER',
//            'FURTHERMORE','G','GET','GETS','GETTING','GIVEN','GIVES','GAVE','GO','GOING','GOOD','GOES',
//            'GOING','GONE','GOT','GOTTEN','GREETINGS','H','HAD','HADN\'T','HELD','HALF','HAPPENS',
//            'HARDLY','HAS','HASN\'T','HAVE','HAVEN\'T','HAVING','HE','HE\'D','HE\'LL',
//            'HELLO','HELP','HENCE','HER','HERE','HEREAFTER','HEREBY','HEREIN','HERE\'S',
//            'HEREUPON','HERS','HERSELF','HE\'S','HI','HIM','HIMSELF','HIS','HOUR','HOURS','HITHER',
//            'HOPEFULLY','HOW','HOWBEIT','HOWEVER','HUNDRED','I','I\'D','IE','IF','IGNORED',
//            'I\'LL','I\'M','IDEA','IMMEDIATE','IN','INCLUDE','INCLUDING','INASMUCH','INC','INC.','INDEED','INDICATE',
//            'INDICATED','INDICATES','INNER','INSIDE','INSOFAR','INSTEAD','INTO','INWARD',
//            'IS','ISN\'T','IT','IT\'D','IT\'LL','ITS','IT\'S','ITSELF','I\'VE','J','JUST',
//            'K','KEEP','KEEPS','KEPT','KNOW','KNOWN','KNOWS','L','LACK','LAST','LATELY','LATER',
//            'LATTER','LATTERLY','LEAST','LESS','LEST','LET','LET\'S','LIKE','LIKED','LIKELY',
//            'LIKEWISE','LITTLE','LONG','LONGER','LOOK','LOOKING','LOOKS','LOW','LOT','LOWER','LTD','M','MADE',
//            'MAINLY','MAKE','MAKES','MAKING','MAN','MEN','MANY','MATTER','MAY','MAYBE','MAYN\'T','ME','MEAN','MEANS','MEANTIME',
//            'MEANWHILE','MERELY','MIGHT','MIGHTN\'T','MILES','MILLION','MINE','MINUS','MORE','MOREOVER','MORNING',
//            'MOST','MOSTLY','MOMENT','MONTH','MUCH','MUST','MUSTN\'T','MY','MYSELF','N','NAME','NAMED',
//            'NAMELY','ND','NEAR','NEARLY','NECESSARY','NEED','NEEDED','NEEDN\'T','NEEDS','NEITHER',
//            'NEVER','NEVERF','NEVERLESS','NEVERTHELESS','NEW','NEXT','NIGHT','NINE','NINETY','NO',
//            'NOBODY','NON','NONE','NONETHELESS','NOONE','NO-ONE','NOR','NORMALLY','NOT',
//            'NOTHING','NOTWITHSTANDING','NOVEL','NOW','NOWHERE','O','OBVIOUSLY','OF','OFF',
//            'OFTEN','OH','OK','OKAY','OLD','ON','ONCE','ONE','ONES','ONE\'S','ONLY','ONTO',
//            'OPPOSITE','OR','OTHER','OTHERS','OTHERWISE','OUGHT','OUGHTN\'T','OUR','OURS',
//            'OURSELVES','OUT','OUTSIDE','OVER','OVERALL','OWN','P','PAGE','PART','PARTICULAR','PARTICULARLY',
//            'PAST','PER','PERHAPS','PLACE','PLACED','PLEASE','PLUS','POINT','POSSIBLE','PRESUMABLY','PROBABLY',
//            'PROVIDED','PROVED','PROVIDES','PUT','Q','QM','QUE','QUESTION','QUITE','QV','R','RATHER','RD','RE','REALLY',
//            'REASONABLY','REPORTED','RECENT','RECENTLY','REGARDING','REGARDLESS','REGARDS','RELATIVELY',
//            'RESPECTIVELY','RIGHT','ROUND','S','SAID','SAME','SAW','SAY','SAYING','SAYS','SEC','SECOND','SECTION',
//            'SECONDLY','SEE','SEEING','SEEM','SEEMED','SEEMING','SEEMS','SENSE','SEEN','SELF','SELVES','SET','SETS',
//            'SENSIBLE','SENT','SERIOUS','SERIOUSLY','SEVEN','SEVERAL','SHALL','SHAN\'T','SHE','SHORT','SHOWED',
//            'SHE\'D','SHE\'LL','SHE\'S','SHOULD','SHOULDN\'T','SINCE','SINGLE','SIX','SMALL','SO','SOME',
//            'SOMEBODY','SOMEDAY','SOMEHOW','SOMEONE','SOMETHING','SOMETIME','SOMETIMES',
//            'SOMEWHAT','SOMEWHERE','SOON','START','STARTED','SORRY','SPECIFIED','SPECIFY','SPECIFYING','STILL',
//            'SUB','SUCH','SUP','SURE','T','TAKE','TAKES','TAKEN','TAKING','TELL','TEN','TENDS','TEXT','TH','THAN',
//            'THANK','THANKS','THANX','THAT','THAT\'LL','THATS','THAT\'S','THAT\'VE','THE','THEIR',
//            'THEIRS','THEM','THEMSELVES','THEN','THENCE','THERE','THEREAFTER','THEREBY','THERE\'D',
//            'THEREFORE','THEREIN','THERE\'LL','THERE\'RE','THERES','THERE\'S','THEREUPON','THERE\'VE',
//            'THESE','THEY','THEY\'D','THEY\'LL','THEY\'RE','THEY\'VE','THING','THINGS','THINK',
//            'THIRD','THIRTY','THIS','THOROUGH','THOROUGHLY','THOSE','THOUGH','THOUGHT','THOUSANDS','THREE','THROUGH',
//            'THROUGHOUT','THRU','THUS','TIME','TINY','TILL','TO','TODAY','TOGETHER','TOLD','TOO','TOOK','TOW','TOWARD','TOWARDS',
//            'TRIED','TRIES','TRULY','TRY','TRYING','T\'S','TWICE','TWO','U','UN','UNDER','UNDERNEATH',
//            'UNDOING','UNFORTUNATELY','UNLESS','UNLIKE','UNLIKELY','UNTIL','UNTO','UP','UPON',
//            'UPWARDS','US','USE','USED','USEFUL','USES','USING','USUALLY','V','VALUE','VARIOUS',
//            'VERSUS','VERY','VIA','VIZ','VS','W','WARNING','WANT','WANTS','WAS','WASN\'T','WAY','WE','WE\'D','WEEK','WEEKS',
//            'WELCOME','WELL','WE\'LL','WENT','WERE','WE\'RE','WEREN\'T','WE\'VE','WHAT','WHATEVER',
//            'WHAT\'LL','WHAT\'S','WHAT\'VE','WHEN','WHENCE','WHENEVER','WHERE','WHEREAFTER','WHEREAS',
//            'WHEREBY','WHEREIN','WHERE\'S','WHEREUPON','WHEREVER','WHETHER','WHICH','WHICHEVER',
//            'WHILE','WHILST','WHITHER','WHO','WHO\'D','WHOEVER','WHOLE','WHO\'LL','WHOM','WHOMEVER',
//            'WHO\'S','WHOSE','WHY','WILL','WILLING','WISH','WITH','WITHIN','WITHOUT','WORD','WONDER','WON\'T',
//            'WOULD','WOULDN\'T','X','Y','YES','YET','YEAR','YEARS','YOU','YOU\'D','YOU\'LL','YOUR','YOU\'RE','YOURS',
//            'YOURSELF','YOURSELVES','YOU\'VE','Z','ZERO','\ \.','\ \.\n','\ \.\ ','a','able','about','above','abroad','according',
//            'accordingly','across','actually','adj','add','added','after','afterwards','again',
//            'against','ago','ahead','ain\'t','all','allow','allows','almost',
//            'alone','along','alongside','already','also','although','always',
//            'am','amid','amidst','among','amongst','an','and','another','any',
//            'anybody','anyhow','anyone','anything','anyway','anyways','anywhere',
//            'apart','appear','appreciate','appropriate','are','aren\'t','around',
//            'as','a\'s','aside','ask','asked','asking','associated','at','available',
//            'away','awfully','b','back','bad','backward','backwards','be','became',
//            'because','become','became','becomes','becoming','been','before','beforehand',
//            'begin','began','behind','being','believe','below','beside','besides','best',
//            'better','between','beyond','big','biggest','both','brought','brief','but','by','c','called','came','can',
//            'cannot','cant','can\'t','cent','complete','continue','caption','cause','causes','certain','certainly',
//            'changes','clearly','c\'mon','co','come','comes','concerning',
//            'consequently','consider','considering','contain','containing','contains',
//            'corresponding','could','couldn\'t','course','c\'s','currently','d','day','decided','decide',
//            'declared','declare','dare',
//            'daren\'t','definitely','described','despite','did','didn\'t','different',
//            'directly','do','does','doesn\'t','doing','done','don\'t','down','downwards',
//            'during','e','each','early','edu','ep','eg','eight','eighty','either','else','elsewhere',
//            'end','ending','enough','entire','entirely','especially','et','etc','even','ever',
//            'evermore','every','everybody','everyone','everything','everywhere','ex',
//            'exactly','example','except','f','face','faced','fell','fact','fairly','far','finally','find','farther','few','fewer',
//            'fifth','first','five','followed','following','follows','fail','failed','for','forever',
//            'former','formerly','forth','forward','found','four','from','further',
//            'furthermore','g','get','gets','getting','given','gives','gave','go','going','good','goes',
//            'going','gone','got','gotten','greetings','h','had','hadn\'t','held','half','happens',
//            'hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll',
//            'hello','help','hence','her','here','hereafter','hereby','herein','here\'s',
//            'hereupon','hers','herself','he\'s','hi','him','himself','his','hour','hours','hither',
//            'hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored',
//            'i\'ll','i\'m','idea','immediate','in','include','including','inasmuch','inc','inc.','indeed','indicate',
//            'indicated','indicates','inner','inside','insofar','instead','into','inward',
//            'is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just',
//            'k','keep','keeps','kept','know','known','knows','l','lack','last','lately','later',
//            'latter','latterly','least','less','lest','let','let\'s','like','liked','likely',
//            'likewise','little','long','longer','look','looking','looks','low','lot','lower','ltd','m','made',
//            'mainly','make','makes','making','man','men','many','matter','may','maybe','mayn\'t','me','mean','means','meantime',
//            'meanwhile','merely','might','mightn\'t','miles','million','mine','minus','more','moreover','morning',
//            'most','mostly','moment','month','much','must','mustn\'t','my','myself','n','name','named',
//            'namely','nd','near','nearly','necessary','need','needed','needn\'t','needs','neither',
//            'never','neverf','neverless','nevertheless','new','next','night','nine','ninety','no',
//            'nobody','non','none','nonetheless','noone','no-one','nor','normally','not',
//            'nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off',
//            'often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto',
//            'opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours',
//            'ourselves','out','outside','over','overall','own','p','page','part','particular','particularly',
//            'past','per','perhaps','place','placed','please','plus','point','possible','presumably','probably',
//            'provided','proved','provides','put','q','qm','que','question','quite','qv','r','rather','rd','re','really',
//            'reasonably','reported','recent','recently','regarding','regardless','regards','relatively',
//            'respectively','right','round','s','said','same','saw','say','saying','says','sec','second','section',
//            'secondly','see','seeing','seem','seemed','seeming','seems','sense','seen','self','selves','set','sets',
//            'sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','short','showed',
//            'she\'d','she\'ll','she\'s','should','shouldn\'t','since','single','six','small','so','some',
//            'somebody','someday','somehow','someone','something','sometime','sometimes',
//            'somewhat','somewhere','soon','start','started','sorry','specified','specify','specifying','still',
//            'sub','such','sup','sure','t','take','takes','taken','taking','tell','ten','tends','text','th','than',
//            'thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their',
//            'theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d',
//            'therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve',
//            'these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think',
//            'third','thirty','this','thorough','thoroughly','those','though','thought','thousands','three','through',
//            'throughout','thru','thus','time','tiny','till','to','today','together','told','too','took','tow','toward','towards',
//            'tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath',
//            'undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon',
//            'upwards','us','use','used','useful','uses','using','usually','v','value','various',
//            'versus','very','via','viz','vs','w','warning','want','wants','was','wasn\'t','way','we','we\'d','week','weeks',
//            'welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever',
//            'what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas',
//            'whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever',
//            'while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever',
//            'who\'s','whose','why','will','willing','wish','with','within','without','word','wonder','won\'t',
//            'would','wouldn\'t','x','y','yes','yet','year','years','you','you\'d','you\'ll','your','you\'re','yours',
//            'yourself','yourselves','you\'ve','z','zero'
        );
        //  'com'  ,  '.' , 'co.' ':'  '/' '-' has been deleted
        $str = preg_replace('/\,|\"|\'|\;|\?|\(|\)|\!|\&|\_/',' ',$input);
        $str = preg_split("/[\s,]+/", $str);

        return $str;

    }

    public static function ngram($arr, $word, $n = 3){

        $len = strlen($word);
        for($i = 0; $i < $len; $i++) {
            if($i > ($n - 2)) {
                $ng = '';
                for($j = $n-1; $j >= 0; $j--) {
                    $ng .= $word[$i-$j];
                }
                array_push($arr, $ng);
            }
        }
        return $arr;
    }

    public static function soundWord($word){

        $word = preg_replace('/B|b|F|f|P|p|V|v/i', '1', $word);
        $word = preg_replace('/C|c|G|g|J|j|K|k|Q|q|S|s|X|x|Z|z/i', '2', $word);
        $word = preg_replace('/D|d|T|t/i', '3', $word);
        $word = preg_replace('/M|m|N|n/i', '5', $word);

        return $word;

    }

    public static function soundAll(){
        $data = DB::table(self::$tableName)
            ->select(
                self::$tableName . '.' . self::$tbid,
                self::$tableName . '.' . self::$tbnameEn
            )
            ->get();

        foreach ($data as $item){

            $word = self::soundWord($item->nameEn);

            DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbid, '=', $item->id)
                ->update([
                    'soundEn' => $word,
                    'updated_at' => Carbon::now(),
                ]);

        }

    }

    public static function weightingWords($resultArr, $queryArr){

//        array:21 [
//            0 => "3o"
//  1 => "to"
//  2 => "1a22"
//  3 => "pas"
//  4 => "ass"
//  5 => "pass"
//  6 => "o5e"
//  7 => "one"
//  8 => "ar2u5e53"
//  9 => "arg"
//  10 => "rgu"
//  11 => "gum"
//  12 => "ume"
//  13 => "men"
//  14 => "ent"
//  15 => "argument"
//  16 => "5a22e"
//  17 => "maz"
//  18 => "azz"
//  19 => "zze"
//  20 => "mazze"
//]


//        array:3 [
//            0 => "Mazzeh"
//  1 => "al-Mazraa"
//  2 => "Hammam Wassel"
//]

//        dd($queryArr);
//        dd($resultArr);

        $weight = [];

        foreach ($resultArr as $reselem){
            $num = 0;
            foreach ($queryArr as $queryelem) {
                $num += (double)(((strlen($reselem) - levenshtein(strtolower($reselem), strtolower($queryelem))) * 10)/strlen($reselem));
            }
//            echo '<pre>' . var_export('-------------',  true) . '</pre>';
//            echo '<pre>' . var_export($reselem,  true) . '</pre>';
//            echo '<pre>' . var_export($num,  true) . '</pre>';
            array_push($weight, $num);

        }

        return $weight;
    }


    public static function getSortedData($weight, $data, $maxrow){

        $sort = [];
        while (sizeof($weight) > 0) {
            $key = array_keys($weight, max($weight));
            foreach ($key as $elem){
                array_push($sort, $elem);
                unset($weight[$elem]);
            }
        }

        $sort = array_slice($sort, 0, $maxrow);

        $returnedData = [];

        foreach ($sort as $elem){
            array_push($returnedData, $data[$elem]);
        }

        return $returnedData;
    }


}
