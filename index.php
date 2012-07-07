<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">


<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="3600" />
  <meta name="revisit-after" content="2 days" />
  <meta name="robots" content="index,follow" />
  <meta name="publisher" content="Iconate GmbH" />
  <meta name="author" content="Iconate GmbH" />
  <meta name="distribution" content="global" />
  
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/mf54_reset.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/mf54_grid.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/mf54_content.css" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico" />
  <title>Pro - Ma | Overview |</title>
</head>

<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!-- Following line MUST remain as a comment to have the proper effect -->
<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->

<body>
  <!-- CONTAINER FOR ENTIRE PAGE -->
  <div class="container">

    <!-- A. HEADER -->         
    <div class="corner-page-top"></div>        
    <div class="header">
      <div class="header-top">
        
        <!-- A.1 SITENAME -->      
        <a class="sitelogo" href="index.html" title="Home"></a>
        <div class="sitename">
          <h1><a href="index.html" title="Home">Pro-Ma</a></h1> 
          <h2>Iconate GmbH</h2>
        </div>
    
        
        <div class="navbutton">
          <ul>
            <li><a href="#" title="English"><img src="./img/icon_flag_us.gif" alt="Flag" /></a></li>
            <li><a href="#" title="Deutsch"><img src="./img/icon_flag_de.gif" alt="Flag" /></a></li>
            <li><a href="#" title="Svenska"><img src="./img/icon_flag_se.gif" alt="Flag" /></a></li>
           <!-- <li><a href="#" title="RSS"><img src="./img/icon_rss.gif" alt="RSS-Button" /></a></li> -->
          </ul>
        </div> 

        <!-- A.3 GLOBAL NAVIGATION -->
        <div class="navglobal">
          <ul>
            
            <li><a href="#" title="">Kontakt</a></li>								
            <li><a href="#" title="">Sitemap</a></li>								                        
            <li><a href="#" title="">Links</a></li>								            
          </ul>
        </div>        
      </div>
        
      <!-- A.4 BREADCRUMB and SEARCHFORM -->
      <div class="header-bottom">

        <!-- Breadcrumb -->
        <ul>
          <li class="nobullet">Du bist hier:&nbsp;</li>
          <li><a href="#">Overview</a></li>
                 
        </ul>

        <!-- Search form -->                  
        <div class="searchform">
          
        </div>
      </div>
    </div>      
    <div class="corner-page-bottom"></div>    
    
    <!-- B. NAVIGATION BAR -->
    <div class="corner-page-top"></div>        
    
  
    <!-- C. MAIN SECTION -->      
    <div class="main">

      <!-- C.1 CONTENT -->
      <div class="content">

        <!-- CONTENT CELL -->                
        <div class="corner-content-1col-top"></div>                        
        <div class="content-1col-nobox">
            <h1>cdaLogReader</h1>
          <table>
            <tr>
                <td>Errors</td>
                <td>Details</td>
                <td>Datum</td>
                <td>IP</td>
                <td>User</td>                
            </tr>      
        
 <?php
 require_once 'config.php';  // Hier Datenbank konfigurieren 
 
 
//Verbindung herstellen  $link -> connect_error
    $link = new mysqli($sqlhost,
            $sqluser,
            $sqlpw,
            $sqldb);
if (true)
{
    echo 'Verbindungsfehler: '.mysqli_connect_error();
    //die();
}
else
{
    $querySelect = "SELECT `error`, `details`, `tstamp`, `IP`, `log_data`";
    $queryFrom ="FROM `sys_log`";
    //
    $queryWhere =" WHERE `details` LIKE '%logged in%' AND `log_data` LIKE '%mk%'";
    //$queryWhere = "";
    $query = $querySelect.$queryFrom.$queryWhere;
    $res = $link ->query($query);
    
    // CSV Erstellen
    $fp = fopen(date('d_m_y').'.csv', 'w');
    while($zeile = $res -> fetch_row())
    {    
            $zeile[2] = date("d.m.y",$zeile[2]);
            $len = strlen($zeile[4]);
            $zeile[4] = substr($zeile[4],0,$len-23);
            $zeile[4] = substr($zeile[4], 14);
            fputcsv($fp, $zeile);     
    } 
    fclose($fp);
    
    
    // Daten als Tabelle ausgeben
    $res = $link ->query($query);
    while($zeile = $res -> fetch_array()){
       echo "<tr>"       
           ."<td>".$zeile['error']."</td>"
           ."<td>".$zeile['details']."</td>"
           ."<td>".date("d.m.y",$zeile['tstamp'])."</td>"
           ."<td>".$zeile['IP']."</td>";
           
      $len = strlen($zeile['log_data']);
      $zeile['log_data'] = substr($zeile['log_data'],0,-32);
      $zeile['log_data'] = substr($zeile['log_data'], 14);
            
      echo "<td>".$zeile['log_data']."</td>"
          ."</tr>";
        
    }
    
    
}

$link ->close();
?>
</table>         
        </div> 
        <div class="corner-content-1col-bottom"></div>                       

                            

       

         

        <!-- CONTENT CELL -->                
       <!--<div class="corner-content-1col-top"></div>                        
        <div class="content-1col-nobox">
          <h1>Release Notes</h1>

          <h3 class="line">Lorem ipsium</h3>
          <h6>March 13, 2012</h6>
          <h5>Full-width option</h5>
          <p><b>New feature:</b> A new option added for full-width content, that is, with no subcontent section. The full-width content section can contain up to three columns</p>
          <h5>Nested side menu</h5>
          <p><b>New feature:</b> The menu in the subcontent section now con contain one additional sublevel menu.</p>
          <h5>Styled table links</h5>
          <p><b>New feature:</b> Styled links in consistency with the general design are now available also for content inside tables.</p>
          <h5>Optimized CSS-class names</h5>
          <p><b>Modified:</b> The terminology of the CSS-class names for the content cells and subcells was confusing. Another vocabulary was introduced, now using the term "1-col", "2-col" and "3-col", instead of earlier "cell" and "subcell". In this way the meaning of the CSS class is more obvious. Furthermore, the advantage of this approach is that the HTML code for pages with sidebar and for pages without sidebar remain fully identical, and thus are 100% interchangeable.</p>          
          <h5>CSS classes for tables</h5>
          <p><b>Modified:</b> The CSS-class "medium" for tables was removed and the formatting made automatic for the tables regardless of their positions in the code. The automatic formatting is done by localizing if the table is in a 1-column, 2-column or 3-column setting.</p>          

          
        </div>
        <div class="corner-content-1col-bottom"></div>     -->                          
      </div>
        
      <!-- C.2 SUBCONTENT -->
      <div class="subcontent">

        <!-- SUBCONTENT CELL -->
        <div class="corner-subcontent-top"></div>                        
        <div class="subcontent-box">
          <h1>Notes</h1>                    
          <h5></h5>
          <p>
          <br /></p>
        </div>  
        <div class="corner-subcontent-bottom"></div>
      
        <!-- SUBCONTENT CELL -->
        <div class="corner-subcontent-top"></div>                        
        <div class="subcontent-box">
          <h1>Tasks</h1>                    
          <h5>Lorem ispium</h5>
          <p>Eingang: 15.05.2006<br />lorem Ipsium<br />&rarr; <a href="#">show</a></p>
          <h5>Lorem Ipsium</h5>
          <p>Eingang: 08.06.2006<br />OK for operational use.<br />&rarr; <a href="#">Latest update</a></p>
          <h5>lorem Ipsium</h5>
          <p>Eingang: 25.11.2006<br />Well suited for operational use.<br />&rarr; <a href="#">Latest update</a></p>
          <h5>Lorem ipsium</h5>
          <p>Eingang: 18.12.2007<br />Well suited for operational use.<br />&rarr; <a href="#">show</a></p>
        </div>  
        <div class="corner-subcontent-bottom"></div>
      </div>    
    </div>
      
    <!-- D. FOOTER -->      
    <div class="footer">
      <p>Copyright &copy; 2012 Max Kirsch&nbsp;&nbsp;|&nbsp;&nbsp;All Rights Reserved</p>
      <p class="credits"><a href="http://validator.w3.org/check?uri=referer" title="Validate XHTML code">XHTML 1.0</a> | <a href="http://jigsaw.w3.org/css-validator/" title="Validate CSS code">CSS 2.0</a></p>
    </div>
    <div class="corner-page-bottom"></div>        
  </div> 
  
</body>
</html>



