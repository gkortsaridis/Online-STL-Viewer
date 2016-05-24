<html>
	<head>
        <title>STL Viewer TEST</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <style>
            body {
                font-family: Monospace;
                background-color: #ffffff;
                margin: 0px;
                overflow: hidden;
            }

            #info {
                color: #fff;
                position: absolute;
                top: 10px;
                width: 100%;
                text-align: center;
                z-index: 100;
                display:block;
            }

            a { color: skyblue }
        </style>
    </head>
	<body>
		<script src="three.js-master/build/three.min.js"></script>
		<script src="three.js-master/examples/js/loaders/STLLoader.js"></script>
		<script src="three.js-master/examples/js/controls/TrackballControls.js"></script>
	
		<script>
			var camera,controls,scene,renderer;
			
			init();
			animate();
			
			function init(){
				camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 1000);
				camera.position.z = 500;
				
				controls = new THREE.TrackballControls(camera);
				controls.addEventListener('change', render);
				
				scene = new THREE.Scene();
				
				// lights
				var light = new THREE.PointLight(0xffffff);
				light.position.set(-100,200,100);
				scene.add(light);
				
				
				
				// object
                var loader = new THREE.STLLoader();
                <?php
	                if(isset($_GET['model'])){
		                $model_url = $_GET['model'];
		                echo "loader.load( '".$model_url."', function ( geometry ) {";
		                echo "var material = new THREE.MeshLambertMaterial( { color: 0xc4c4c4 } );";
		                echo "var mesh = new THREE.Mesh( geometry, material );";
		                echo "scene.add( mesh );";
		                echo "} );";
	                }
	            ?>
                
                
                var material_blue = new THREE.LineBasicMaterial({
					color: 0x0000ff
    			});
    			
    			var material_red = new THREE.LineBasicMaterial({
					color: 0xff0000
    			});
    			
    			var material_green = new THREE.LineBasicMaterial({
					color: 0x00ff00
    			});
    			
    			var x_line = new THREE.Geometry();
				x_line.vertices.push(new THREE.Vector3(0, 0, 0));
				x_line.vertices.push(new THREE.Vector3(10000, 0, 0));
			    var line = new THREE.Line(x_line, material_red);
			    scene.add(line);	
			    
				var y_line = new THREE.Geometry();
				y_line.vertices.push(new THREE.Vector3(0, 0, 0));
				y_line.vertices.push(new THREE.Vector3(0, 10000, 0));
			    var line = new THREE.Line(y_line, material_green);
			    scene.add(line);
			    
			    var z_line = new THREE.Geometry();
				z_line.vertices.push(new THREE.Vector3(0, 0, 0));
				z_line.vertices.push(new THREE.Vector3(0, 0, 10000));
			    var line = new THREE.Line(z_line, material_blue);
			    scene.add(line);		
							
				renderer = new THREE.WebGLRenderer();
				renderer.setSize(window.innerWidth, window.innerHeight);
				renderer.setClearColor( 0xF0F8FF, 1);
				renderer.render(scene, camera);
				document.body.appendChild(renderer.domElement);
			}
			
			function animate(){
				requestAnimationFrame(animate);
				controls.update();
			}
		
			function render(){
				renderer.render(scene,camera);
			}
			
		</script>
	
	</body>
</html>