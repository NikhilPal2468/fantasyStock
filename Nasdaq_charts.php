<?php
require 'connection.php';
// define variables and set to empty values

$Stock_Id = $_GET['sid'];


           $query = "SELECT * FROM nasdaq_list where unique_id =$Stock_Id";
                        $run = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($run);
                        $Url = $row['Url'];
                        $Stock_Name=$row['Stock_Name'];
                        $Stock_chart_name=explode("quotes/",$Url);
                        
                        ?>
                        <style>
                            .title{
                                width:100%;
                                height:10%;
                                text-align:center;
                            }
                        .title p{
                            font-size:25px;
                        
                            
                        }
                        </style>

<!-- TradingView Widget BEGIN -->
<div class="title">
    <p>
        <?php echo $Stock_Name; ?>
    </p>
</div>
<div class="tradingview-widget-container">
  <div id="tradingview_56b52"></div>
  <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/symbols/NASDAQ-<?php echo $Stock_chart_name[1]; ?>" rel="noopener" target="_blank"><span class="blue-text">ETHUSD Chart</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": "100%",
  "height": "90%",
  "symbol": "NASDAQ:<?php echo $Stock_chart_name[1]; ?>",
  "interval": "1",
  "timezone": "Asia/Kolkata",
  "theme": "dark",
  "style": "2",
  "locale": "in",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "container_id": "tradingview_56b52"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->