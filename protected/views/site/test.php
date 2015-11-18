

	<link rel="stylesheet" href="http://cdn-sg1.pgimgs.com/cssprod/propertyguru/layout.css?190514_10" type="text/css"/>

			<script type="text/javascript" src="http://cdn-sg1.pgimgs.com/jsprod/jquery.js?190514_10"></script>

                <div class="map-wrapper">
                    <div class="map-window">
                            <div class="map-caption">
                                 <span class="bluetext">The Waterina</span>, 51 Lorong 40 Geylang 398075
                            </div>

                            <div class="map-div" id="map-div"></div>       
                    </div>

                </div>	
	
        
                     
                
			<script type="text/javascript" src="http://www.streetdirectory.com/js/map_api/m.php?api=9d8ec051c66464b06807209ae334986c39a3c7ae"></script> 
			<script type="text/javascript" src="http://www.propertyguru.com.sg/js/mxn/mxn.js?(streetdirectory)"></script>
                        
			<script type="text/javascript">
				$(function () {
					var m = new mxn.Mapstraction('map-div','streetdirectory');
					m.addControls({zoom:'small'});
					var myPoint = new mxn.LatLonPoint(1.312741,103.890138)
					m.setCenterAndZoom(myPoint, 16);
					//Nearby MRTs
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3083536684875, 103.88828516006)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>CC8 Dakota MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3182001528756, 103.89268398285)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>CC9 Paya Lebar MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3182216048689, 103.89330625534)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>EW8 Paya Lebar MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.316473, 103.882914)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>EW9 Aljunied MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3063157202588, 103.88249158859)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>CC7 Mountbatten MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3266093200555, 103.89000177383)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>CC10 MacPherson MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.319768, 103.903303)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>EW7 Eunos MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.302883382665, 103.87528181076)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>CC6 Stadium MRT Station</b></td></tr></table>",				
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/mrt_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
                    					//Nearby Schools
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.311138, 103.888182)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Kong Hwa School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.308252, 103.891128)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Northlight School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.307371, 103.886357)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Broadrick Secondary School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.306049, 103.891561)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Chung Cheng High School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.307907, 103.89609)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Tanjong Katong Girls&#039; School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.317819, 103.883897)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Geylang Methodist School </b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.308305, 103.897601)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Tanjong Katong Secondary School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3220753, 103.8913443)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Eton House International Primary School and Preschool</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.303538, 103.897537)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Canadian International School (CISS) - Tanjong Katong Campus</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.30523, 103.900079)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Tanjong Katong Primary School </b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.303444, 103.898623)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Chatsworth International School - East Campus</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.311597, 103.903079)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Haig Girls&#039; School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.324757, 103.881576)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Macpherson Primary School </b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.328316, 103.888225)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Macpherson Secondary School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.2988503800175, 103.88253450394)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Dunman High School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.326435, 103.881427)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Canossa Convent Primary School </b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.31721, 103.906954)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Telok Kurau Secondary School</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/school_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
					                                        
					//Nearby Supermarket
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3141887288831, 103.88840809325)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;GEYLANG&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3169198, 103.8940596)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Super&lt;/i&gt; - &lt;b&gt;TANJONG KATONG COMPLEX&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.307978, 103.8847001)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;MOUNTBATTEN&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.319291, 103.894819)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;SINGAPORE POST CENTRE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3155683, 103.8990709)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;JOO CHIAT COMPLEX&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.321746, 103.886822)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;ALJUNIED&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.312545, 103.878641)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Sheng Siong - &lt;b&gt;GEYLANG 301&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3098316014447, 103.90219394907)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Super&lt;/i&gt; - &lt;b&gt;JK CENTRE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.32128, 103.903556)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;EUNOS&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3054144655383, 103.90472928836)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Cold Storage &lt;i&gt;Market Place&lt;/i&gt; - &lt;b&gt;I12 KATONG&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.32849, 103.885399)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;CIRCUIT ROAD&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.31751, 103.87409)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;BOON KENG&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3023579, 103.876445)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Cold Storage - &lt;b&gt;KALLANG LEISURE PARK&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3018595, 103.9044009)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Hyper&lt;/i&gt; - &lt;b&gt;PARKWAY PARADE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3014702, 103.9051552)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Cold Storage - &lt;b&gt;PARKWAY PARADE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3014702, 103.9051552)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Isetan &lt;i&gt;Katong&lt;/i&gt; - &lt;b&gt;PARKWAY PARADE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.314379, 103.8708928)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Express&lt;/i&gt; - &lt;b&gt;UPPER BOON KENG ROAD&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.302554, 103.906736)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Express&lt;/i&gt; - &lt;b&gt;MARINE PARADE CENTRAL&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3290144, 103.9023045)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Super&lt;/i&gt; - &lt;b&gt;UBI AVENUE 1&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3013862444911, 103.90724024841)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Finest&lt;/i&gt; - &lt;b&gt;MARINE PARADE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.320553, 103.870154)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;KALLANG BAHRU&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3237319684942, 103.91077746435)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>NTUC FairPrice &lt;i&gt;Supermarket&lt;/i&gt; - &lt;b&gt;KEMBANGAN&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3342396, 103.8788893)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Prime Supermarket - &lt;b&gt;JOO SENG 01&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.305628, 103.915389)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Giant &lt;i&gt;Express&lt;/i&gt; - &lt;b&gt;MARINE TERRACE&lt;/b&gt;</b></td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/market_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
					                                        //Nearby Bus Stops
                                        											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3122547571676, 103.89061824954)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Opp Versailles Condominium (B81149)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M,197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3120028927522, 103.89033489811)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Versailles Condominium (B81141)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M,197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3148145792433, 103.89126753900)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Opp Lorong 39 Geylang (B81069)</b></td></tr><tr><td>Geylang Road</td></tr><tr><td>Bus Services: 2,13,21,26,40,51,67#,853#,NR7#</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3142435692670, 103.89195658561)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Grandlink Square (B81139)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M,197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3142442969472, 103.89216823870)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Opp Grandlink Square (B81131)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3115066252618, 103.88784210536)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Kong Hwa School (B81151)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M,197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3140575997626, 103.88752408262)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Aft Lorong 34 Geylang (B81049)</b></td></tr><tr><td>Geylang Road</td></tr><tr><td>Bus Services: 2,13,21,26,40,51,67#,853#,NR7#</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3115819168728, 103.88730840131)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Opp Chung Cheng High (B81159)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 7,70,70M,197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3140013618708, 103.89304380907)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Opp City Plaza (B82231)</b></td></tr><tr><td>Guillemard Road</td></tr><tr><td>Bus Services: 197</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
											m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.3165428021450, 103.89020778939)) ,{
							infoBubble : "<table class='table-infobubble'><tr><td><b>Sims Ville (B81051)</b></td></tr><tr><td>Sims Avenue</td></tr><tr><td>Bus Services: 2,13,21,26,40,51,67#,853#,NR7#</td></tr></table>",
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/bus_32.png",
							iconSize : [32,32],
							draggable : false,
							hover : true
						});        
					                                            
                                                                                
					//Nearby Buildings
						
					//Nearby Construction
						
                                        
					//Nearby Interests
															
					 
					m.addMarkerWithData(new mxn.Marker(myPoint) ,{
						icon : "http://www.propertyguru.com.sg/images/pg/maptool/condo_32_h.png",
						iconSize : [32,70],
						draggable : false,
						label : "The Waterina",
						infoBubble: "<table class='table-infobubble'><tr><td><img src='http://cdn-sg1.pgimgs.com/images/thumb/b/5/8/0/b5801d17683357_1_V75B.jpg'></td><td><b>The Waterina</b><BR/>51 Lorong 40 Geylang<BR />398075</td></tr></table>",
						hover : true
					});
				});
			</script>