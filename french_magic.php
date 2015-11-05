<?php
	//Hilarious French accent generator ver. 1
	//Authored by Sean Patrick Payne, 15/11/2014
	//Simply pass a string into the make_french() function to create bastardised fake French
	
	//Set UTF8 as I've had funny characters bugger up the POST string before
	mb_internal_encoding("UTF-8");
	
	//Look for input
	if($_POST && isset($_POST['to_convert'])){
		
		//Reassign
		$text = htmlspecialchars($_POST['to_convert']);
		
		//Do some cleanup
		$text = strip_tags($text);
		$text = trim(preg_replace('/\s\s+/', ' ', $text));
		
		//Run function
		$text = make_french($text);
		
	}
	
	//The crucial function that does everything
	function make_french($text){
	
		//Input?
		if(!$text){
			return FALSE;
		}
		
		//Lowercase the entire lot!
		//$text = strtolower($text);
		
		//Prelim changes...
		//$text = str_ireplace('!','! Sacrebleu!',$text);
		$text = str_ireplace('age','aje',$text);
		$text = str_ireplace('ale','aile',$text);
		$text = str_ireplace('ant','ent',$text);
		$text = str_ireplace('ared','aired',$text);
		$text = str_ireplace('ay','ai',$text);
		$text = str_ireplace('blem','blaim',$text);
		$text = str_ireplace('ble','buhl',$text);
		$text = str_ireplace('bout','but',$text);
		$text = str_ireplace('ck','k',$text);
		$text = str_ireplace('eal','eahl',$text);
		$text = str_ireplace('ear','air',$text);
		//$text = str_ireplace('en','on',$text);
		$text = str_ireplace('ess','ez',$text);
		$text = str_ireplace('ew','u',$text);
		$text = str_ireplace('gen','jen',$text);
		$text = str_ireplace('gon','jen',$text);
		$text = str_ireplace('ies','ees',$text);
		$text = str_ireplace('ill','eehl',$text);
		$text = str_ireplace('ing','eng',$text);
		$text = str_ireplace('ired','iaired',$text);
		$text = str_ireplace('ire','iyaire',$text);
		$text = str_ireplace('ise','ize',$text);
		$text = str_ireplace('ising','izeeng',$text);
		$text = str_ireplace('ist','eest',$text);
		$text = str_ireplace('ith','iv',$text);
		$text = str_ireplace("it's",'eet eez',$text);
		$text = str_ireplace("i've",'I have',$text);
		$text = str_ireplace('lar','lair',$text);
		$text = str_ireplace('logic','lojic',$text);
		$text = str_ireplace('loth','luth',$text);
		$text = str_ireplace('ment','mont',$text);
		$text = str_ireplace('ol','ul',$text);
		$text = str_ireplace('ool','oo-el',$text);
		$text = str_ireplace('oom','uhm',$text);
		$text = str_ireplace('orl','hirl',$text);
		$text = str_ireplace('or','air',$text);
		$text = str_ireplace('our','ur',$text);
		$text = str_ireplace('oute','oote',$text);
		$text = str_ireplace('out','oot',$text);
		$text = str_ireplace('shion','she-on',$text);
		$text = str_ireplace('sion','she-on',$text);
		$text = str_ireplace('some','zum',$text);
		$text = str_ireplace('stion','stshe-on',$text);
		$text = str_ireplace('suit','zoot',$text);
		$text = str_ireplace('them','zem',$text);
		$text = str_ireplace('thing','theeng',$text);
		$text = str_ireplace('tion','she-on',$text);
		$text = str_ireplace('tle','-tell',$text);
		$text = str_ireplace('ture','tuair',$text);
		$text = str_ireplace('ty','tay',$text);
		$text = str_ireplace('ver','vair',$text);
		$text = str_ireplace("you've",'you have',$text);
		
		//Explode the text into an array (if there's spaces to explode on!)
		if(strstr($text, ' ')){
			$text = explode(' ',$text);
		} else {
			$text = array($text);
		}

		//And now a whole bunch of string replaces, loop through words...
		foreach($text as $key => $word){
		
			//DEBUG
			//echo $word . " " . strlen($word) . "<br />";
			//echo compare_format($word) . "<br />";
			
			//French people can never say "hello" as per the factual show 'allo 'allo.
			if(compare_format($word) == "hello"){
				$text[$key] = str_ireplace('hello',"'allo 'allo",$word);
			} elseif(compare_format($word) == "hi"){
				$text[$key] = str_ireplace('hi',"'allo",$word);
			//French people can't say the letter "h" at the beginning of words
			} elseif(compare_format($word) != "hello" && compare_format($word) != "hi"){
				if($word != "the" && substr($word, 0, 1) == 'h'){
					$text[$key] = "'" . substr($word,1);
				}
			}

			//French people can't say the letter "I" by itself
			if(compare_format($word) == "i"){
				$text[$key] = "ai";
			}
			
			//French people don't say "yes" or "no" like normal people
			if(compare_format($word) == "yes"){
				$text[$key] = str_ireplace('yes', 'oui', $word);
			}
			if(compare_format($word) == "no"){
				$text[$key] = str_ireplace('no', 'non', $word);
			}

			//French people always say "monsieur" instead of "sir"
			if(compare_format($word) == "sir"){
				$text[$key] = str_ireplace('sir', 'Monsieur', $word);
			}
			if(compare_format($word) == "mister"){
				$text[$key] = str_ireplace('mister', 'Monsieur', $word);
			}
			
			//Likewise they call women "mademoiselle"
			if(compare_format($word) == "madam"){
				$text[$key] = str_ireplace('madam', 'Mademoiselle', $word);
			}
			if(compare_format($word) == "missus"){
				$text[$key] = str_ireplace('missus', 'Mademoiselle', $word);
			}
			
			//French people have weird articles
			if(compare_format($word) == "it"){
				$text[$key] = str_ireplace('it','eet',$word);
			}
			if(compare_format($word) == "is"){
				$text[$key] = str_ireplace('is','eez',$word);
			}
			if(compare_format($word) == "in"){
				$text[$key] = str_ireplace('in','een',$word);
			}
			if(compare_format($word) == "and"){
				$option = rand(1,4);
				switch($option){
					case 1:
						$text[$key] = str_ireplace('and','et',$word);
					break;
					case 2:
					case 3:
					case 4:
					default:
						$text[$key] = "and";
				}	
			}
			if(compare_format($word) == "my"){
				$text[$key] = str_ireplace('my','mon',$word);
			}
			
			//French people can't even get basic numbers right
			if(compare_format($word) == "one"){
				$text[$key] = str_ireplace('one','un',$word);
			}
			if(compare_format($word) == "two"){
				$text[$key] = str_ireplace('two','deux',$word);
			}
			
			//French people stretch the bollocks off "ly"
			if(stristr($word, "ly") && substr_compare($word, "ly", -2, 2) == 0){
				$text = str_ireplace('ly','-lee',$text);
			}
			
			//French people can't say things like "spectre", only "spectaire"
			if(stristr($word, "tre") && substr_compare($word, "tre", -3, 3) == 0){
				$text = str_ireplace('tre','tair',$text);
			}
			if(stristr($word, "ke") && substr_compare($word, "ke", -2, 2) == 0){
				$text = str_ireplace('ke','k',$text);
			}
			
			//French people can't make their mind up about how to say "the"
			if(compare_format($word) == "the"){
				$option = rand(1,3);
				switch($option){
					case 1:
						$text[$key] = str_ireplace('the','le',$word);
					break;
					case 2:
						$text[$key] = str_ireplace('the','la',$word);
					break;
					case 3:
					default:
						$text[$key] = str_ireplace('the','ze',$word);
				}
			}
			
			//French people say a lot of 'zee's
			if(compare_format($word) == "that"){
				$text[$key] = str_ireplace('that', 'zat', $word);
			}
			if(compare_format($word) == "they"){
				$text[$key] = str_ireplace('they', 'zey', $word);
			}
			if(compare_format($word) == "this"){
				$text[$key] = str_ireplace('this','zis',$word);
			}
			if(compare_format($word) == "their"){
				$text[$key] = str_ireplace('their','zeir',$word);
			}
			if(compare_format($word) == "there"){
				$text[$key] = str_ireplace('there','zere',$word);
			}
			if(stristr($word, "er") && !stristr($word, "there")) {
				$text[$key] = str_ireplace('er','air',$word);
			}
			if(compare_format($word) == "then"){
				$text[$key] = str_ireplace('then','zen',$word);
			}
			if(compare_format($word) == "these"){
				$text[$key] = str_ireplace('these','zese',$word);
			}
			if(compare_format($word) == "so"){
				$text[$key] = str_ireplace('so','zo',$word);
			}
			
			//French people don't even use the term "french" (silly French sods)
			if(compare_format($word) == "french"){
				$text[$key] = str_ireplace('french','Francais',$word);
			}
			
			//Bonus! Swearing!
			if(compare_format($word) == "shit"){
				$text[$key] = str_ireplace('shit','merde',$word);
			}
			if(compare_format($word) == "god"){
				$text[$key] = str_ireplace('god','Dieu',$word);
			}
			
			//DEBUG
			//echo $word . " " . strlen($word) . "<br />";
			
		}
		
		//Put it all back together!
		$text = implode(' ',$text);
		
		//Cleanup replacements
		//$text = str_ireplace('ttle','tle',$text);
		$text = str_ireplace('beee','be-ee',$text);
		
		//Now we do some clever "e" replacements
		$text = make_funny_es($text);
		
		//Capitalise all first letters
		$text = preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst($text));
		
		//Finally certain characters can cause slashes to appear so let's bodge that fix with stripslashes()
		//Apparently you don't need this if magic quotes is turned off but my server is rubbish so I do need this
		$text = stripslashes($text);
		
		//Output changed text
		return $text;
	
	}
	
	//Formats for comparison
	function compare_format($word){
		
		//Input?
		if(!$word){
			return FALSE;
		}
		
		//Set an array with common punctuation
		$punctuation = array('.',',','!','?','"',"'");
		
		//Remove punctuation, lowercase the word
		$word = str_replace($punctuation,'',$word);
		$word = strtolower($word);
		
		//Return formatted word
		return $word;
		
	}
	
	//Replaces random e's with the French French ones
	function make_funny_es($text){
		
		//Input?
		if(!$text){
			return FALSE;
		}
		
		//Explode the text on "e"
		$bits = explode('e',$text);
		
		//Wipe the text var
		$text = "";
		
		//Loop and reassemble the text, gluing it together with regular and French e's
		foreach($bits as $bit){
			
			//Random option
			$option = rand(1,4);
			
			//Every one in four e's will be a French one!
			switch($option){
				case 4:
					$text .= $bit . '&eacute;';
				break;
				case 1:
				case 2:
				case 3:
				default:
					$text .= $bit . 'e';
			}
			
		}
		
		//It looks a bit odd to have a regular 'e' next to a French 'e' so fix that...
		$text = str_ireplace('e&eacute;','ee',$text);
		$text = str_ireplace('&eacute;e','ee',$text);
		$text = str_ireplace('&eacute;&eacute;','ee',$text);
		
		//Because we're gluing the strings together with the letter "e", we end up with a random e at the end. Strip it off
		$text = rtrim($text,'e');
		$text = rtrim($text,'&eacute;');
		
		//Spit the text out with its new e's...
		return $text;
		
	}
	
?>