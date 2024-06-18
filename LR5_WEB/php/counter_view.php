<html>
<head>
<title>Счётчик посещений</title>
</head>
<body>
<link rel="stylesheet" href="/css/style.css"/>
<?php echo '<h1>Привет!</h1>'; ?>
<?php 
date_default_timezone_set('Europe/Moscow');
$filename = "pageview_counter.txt";                      
if (file_exists($filename))                             
{                  
    $count = file_get_contents($filename);              
    //if($count%10==0)  каждое десятое посещение
    if($count==10)
    {    
        $date=date('d.m.Y H:i:s');
            $quotes= array();
            $quotes=glob("images/*.*");                    
            $number = mt_rand(0, count($quotes) - 1);
            $url = $quotes[$number];
            $image = "<img src='/$url' width='300' height='300' alt='Картинка'>";        
            echo '<table>';
echo '<tr>';
echo '<th>Посещения</th>';
echo '</tr>';
echo '<tr>';
echo '<td>Это деcятое посещение!!!</td>';
echo '</tr>';
echo '<tr>';
echo "<td>{$image}</td>";
echo '</tr>';
echo '<tr>';
echo "<td>$date</td>";
echo '</tr>';
            echo '</table>';
    }   
}
else   
{                                              
    $count = 1;                                 
}
if($count>=10)
{
$count=0; 
}  
else
{
    echo "<p>$count</p>";                      
}                                
file_put_contents($filename, ++$count);                                                                                                 
?>                                              
</body>
</html>