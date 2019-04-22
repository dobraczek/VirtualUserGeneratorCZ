<?php

/**
 * User Virtual Generator CZ
 * @author Dobr@CZek
 * @link http://webscript.cz
 * @version 1.0
 */

namespace VirtualUserGeneratorCZ;

class User {
    
    var $sex = 3;               // define sex / 1 = men / 0 = woman / 3 = all sex
    var $age_min = 18;          // min age
    var $age_max = 80;          // nax age
    var $pathRuian = "Ruian/";  // folder - Rulian CSV file
    var $nickname;
    var $username;
    
    
	private function RuianCountFile()
	{
	    $folder = opendir($this->pathRuian);
	    while ($file = readdir($folder))
	       $files[] = $file;
	    
	    $count = count($files);
	    $rand = rand(2, $count-1);
	       
	    return $files[$rand];
	}


	private function cs_utf2ascii($s) {
	    static $tbl = array("\xc3\xa1"=>"a","\xc3\xa4"=>"a","\xc4\x8d"=>"c","\xc4\x8f"=>"d","\xc3\xa9"=>"e",
	        "\xc4\x9b"=>"e","\xc3\xad"=>"i","\xc4\xbe"=>"l","\xc4\xba"=>"l","\xc5\x88"=>"n","\xc3\xb3"=>"o",
	        "\xc3\xb6"=>"o","\xc5\x91"=>"o","\xc3\xb4"=>"o","\xc5\x99"=>"r","\xc5\x95"=>"r","\xc5\xa1"=>"s",
	        "\xc5\xa5"=>"t","\xc3\xba"=>"u","\xc5\xaf"=>"u","\xc3\xbc"=>"u","\xc5\xb1"=>"u","\xc3\xbd"=>"y",
	        "\xc5\xbe"=>"z","\xc3\x81"=>"A","\xc3\x84"=>"A","\xc4\x8c"=>"C","\xc4\x8e"=>"D","\xc3\x89"=>"E",
	        "\xc4\x9a"=>"E","\xc3\x8d"=>"I","\xc4\xbd"=>"L","\xc4\xb9"=>"L","\xc5\x87"=>"N","\xc3\x93"=>"O",
	        "\xc3\x96"=>"O","\xc5\x90"=>"O","\xc3\x94"=>"O","\xc5\x98"=>"R","\xc5\x94"=>"R","\xc5\xa0"=>"S",
	        "\xc5\xa4"=>"T","\xc3\x9a"=>"U","\xc5\xae"=>"U","\xc3\x9c"=>"U","\xc5\xb0"=>"U","\xc3\x9d"=>"Y",
	        "\xc5\xbd"=>"Z");
	    return strtr($s, $tbl);
	}
	
	private function name()
	{
	    $array = json_decode(file_get_contents("name.json"), 1);
	    
	    if($this->sex != 3)
	    {
    	    foreach ($array as $value)
    	    {
    	        $sex = $value['sex'];
    	        
    	        $name[$sex][] = array(
    	            'sex' => $sex,
    	            'name' => $value['name'],
    	            'nameday' => $value['nameday']
    	        );
    	    }
    	    
    	    $count = count($name[$this->sex]);
    	    $rand = rand(0, $count-1);
    	    return $name[$this->sex][$rand];
    	    
	    }
	    else
	    {
            $count = count($array);
            $rand = rand(0, $count-1);
            return $array[$rand];
	    }
	}
	
	
	private function surname()
	{
	    $array = json_decode(file_get_contents("surname.json"), 1);
	     
	    if($this->sex != 3)
	    {
	        foreach ($array as $value)
	        {
	            $sex = $value['sex'];
	             
	            $surname[$sex][] = array(
	                'sex' => $sex,
	                'surname' => $value['surname']
	            );
	        }
	        	
	        $count = count($surname[$this->sex]);
	        $rand = rand(0, $count-1);
	        return $surname[$this->sex][$rand];
	        	
	    }
	    else
	    {
	        $count = count($array);
	        $rand = rand(0, $count-1);
	        return $array[$rand];
	    }
	}
	
	private function phone()
	{
	    $code = array(
	        '601', '602', '606', '607', '702', '720', '721', '722', '723', '724', '725', '726', '727', '728', '729', // O2
	        '603', '604', '605', '730', '731', '732', '733', '734', '735', '736', '737', '738', '739', // T-Mobile
	        '608', '770', '771', '772', '773', '774', '775', '776', '777', '778' // Vodafone
	    );
	    
	    $count = count($code);
	    $rand = rand(0, $count-1);
	    
	    return $code[$rand].rand(100, 999).rand(100, 999);
	    
	}
	
	
	private function address()
	{
        if (($handle = fopen($this->pathRuian.$this->RuianCountFile(), "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {   
                for ($c=0; $c < count($data); $c++)
                    $row[] = iconv('windows-1250', 'UTF-8', $data[$c]) . "<br />\n";
                
            }
        }
        
        $count = count($row);
        $rand = rand(1, $count-1);
        
        $record = $row[$rand];
        return explode(";", $record);
	}
	
	private function email($name, $surname)
	{
	    $nickname = json_decode(file_get_contents("nickname.json"), 1);
	    
	    $domain = array(
            '@zin.eu', '@czin.cz', '@czin.sk', '@tiscali.cz', '@wo.cz', '@worldonline.cz', '@atlas.cz', '@kamarad.cz',
            '@mujmejl.cz', '@mujweb.cz', '@podvodnik.cz', '@senior.cz', '@centrum.cz', '@e-mail.cz', '@katedrala.cz',
	        '@eposta.cz', '@e-posta.cz', '@bigboss.cz', '@dablik.cz', '@dobrafirma.cz', '@potvurka.cz', '@soukromy.cz',
	        '@tajny.cz', '@uletak.cz', '@uletacka.cz', '@sexygirl.cz', '@studentka.cz', '@quick.cz',
	        '@seznam.cz', '@post.cz', '@email.cz', '@volny.cz', '@vol.cz', '@klikni.cz', '@gmail.com', '@hotmail.cz'
	    );
        
        $int = rand(1, 7);
        $count = count($nickname);
        $rand = rand(1, $count-1);
        
        if($int == 1)
            $email = strtolower($this->cs_utf2ascii($name).'.'.$this->cs_utf2ascii($surname));
        elseif($int == 2)
            $email = strtolower($this->cs_utf2ascii($name[0]).$this->cs_utf2ascii($surname));
        elseif($int == 3)
            $email = strtolower($this->cs_utf2ascii($surname));
        elseif($int == 4)
            $email = strtolower($this->cs_utf2ascii($surname)).rand(1, 80);
        elseif($int == 5)
            $email = strtolower($this->cs_utf2ascii($surname)).'.'.rand(1, 80);
        elseif($int == 6)
            $email = strtolower($this->cs_utf2ascii($surname).'.'.$this->cs_utf2ascii($name));
        else
            $email = $this->cs_utf2ascii($nickname[$rand]['nick']);
       
        $this->nickname = $nickname[$rand]['nick'];
        $this->username = $email;

        $count = count($domain);
        $rand = rand(1, $count-1);
            
	    return $email.$domain[$rand];
	}
	
	private function birthday()
	{   
        $day = rand(1, 28);
        $moon = rand(1, 12);
	    $year = rand((Date("Y")-($this->age_max+1)), Date("Y")-($this->age_min+1));
	    $date = $rok.'-'.$moon.'-'.Date("y");
	    $datet = Date("Y-m-d");
	    
	    return array(
	        'date' => $day.'.'.$moon.'.'.$year,
	        'age' => ($date < $datet ? (Date("Y")-$year-1) : (Date("Y")-$year))
	    );
	}
	
	
	public function getUser()
	{    
	    $address = $this->address();
	    $name = $this->name();
	    $surname = $this->surname();
	    $birthday = $this->birthday();
	    $email = $this->email($name['name'], $surname['surname']);
	    
	    $user = array(
	        'sex' => ($name['sex'] ? 'muž' : 'žena'),
	        'name' => $name['name'],
	        'surname' => $surname['surname'],
	        'nickname' => $this->nickname,
	        'username' => $this->username,
	        'email' => $email,
	        'phone' => $this->phone(),
	        'nameday' => $name['nameday'],
	        'birthdate' => $birthday['date'],
	        'age' => $birthday['age'],
	        'street' => $address[8],
	        'street_num' => $address[12],
	        'city' => $address[2],
	        'zip' => $address[15]
	    );
	    
	    return $user;
	}
	
}
?>
