<?php
//ini_set( 'display_errors', 'Off' ); 
session_start();
$log2 = $_SESSION['login'];
$_SESSION["zalogowany"]; 
if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0; 

		$servername = "serwer1699338.home.pl";
		$username = "21777739_jozwiak";
		$password = "zaq1@WSX";
		$dbname = "21777739_jozwiak";

//³¹czenie siê z serwerem bazy danych
$polaczenie = @mysql_connect($servername, $username, $password )
or die('Brak po³¹czenia z serwerem MySQL.<br />B³¹d: '.mysql_error()); 
 
//³¹czenie siê z konkretn¹ baz¹ danych na serwerze
$bazadanych = @mysql_select_db($dbname, $polaczenie) 
or die('Nie mogê po³¹czyæ siê z baz¹ danych<br />B³¹d: '.mysql_error()); 



function PokazLogin($komunikat=""){
	echo "$komunikat<br>";
	echo "<form action='index.php' method=post>";
	echo "Login: <input type=text name=login><br>";
	echo "Haslo: <input type=password name=haslo><br>";
	echo "<input type=submit value='Zaloguj!'>";
	echo "</form>";
	}

$log = $_POST["login"];
if($_GET["wyloguj"]=="tak"){
	$_SESSION["zalogowany"]=0;
	echo "Zostales wylogowany z serwisu";
}
if($_SESSION["zalogowany"]!=1){
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
		if(mysql_num_rows(mysql_query("SELECT * from users where user = '".htmlspecialchars($_POST["login"])."' AND pass = '".htmlspecialchars($_POST['haslo'])."'"))){
			$data = new DateTime();
			$data = date('Y-m-d');
			$godzina = new DateTime();
			$godzina = date('H:i:s');
			$query1 = mysql_query("INSERT INTO logi (idLogowania,user,data,godzina,liczba_logowan) VALUES ('','$log','$data','$godzina','1')") or die('Blad zapytania');
			
			}
		else echo PokazLogin("Podaj poprawne dane!");
		}
	else PokazLogin();
}
else{
echo "Zalogowano poprawnie. 
			<a href='index.php'>Przejdz do strony glownej</a>";
			$_SESSION["zalogowany"]=1;
			$_SESSION['login']=$_POST['login'];

echo "<h2>Witaj uzytkowniku   $log2 </h2>"; 

?>


<br>
<br>
<br><a href='index.php?wyloguj=tak'>wyloguj sie</a>
<?php
}
mysql_close($polaczenie); 
?>
