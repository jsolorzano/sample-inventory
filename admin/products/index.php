<?php
session_start();
require_once '../../config/config.php';
if (!isset($_SESSION['logged_in'])) {
	header('Location: '.WEB_HOST.SYSTEM_PATH.'login.php');
}
require_once '../../config/conexion.php';
//Llamado a bitacora
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Sweet Alert -->
    <link href="../../vendor/sweetalert/css/sweetalert.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo WEB_HOST.SYSTEM_PATH;?>admin/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sistema
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Mantenimiento</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos:</h6>
                        <a class="collapse-item active" href="<?php echo WEB_HOST.SYSTEM_PATH;?>admin/products/index.php">Productos</a>
                        <a class="collapse-item" href="<?php echo WEB_HOST.SYSTEM_PATH;?>admin/users/index.php">Usuarios</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo WEB_HOST.SYSTEM_PATH;?>assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Inventario</h1>
                        <a href="#" id="generar_reporte" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
							<i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                        </a>
                    </div>
                    
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="#" id="new_product" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
							<i class="fas fa-plus fa-sm text-white-50"></i> Nuevo
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de productos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código de Producto</th>
                                            <th>Nombre Producto</th>
                                            <th>Descripción</th>
                                            <th>Precio Unitario</th>
                                            <th>Unidades</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código de Producto</th>
                                            <th>Nombre Producto</th>
                                            <th>Descripción</th>
                                            <th>Precio Unitario</th>
                                            <th>Unidades</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
										$sql="SELECT * FROM tbl_catalogoproducto";

										$result=mysqli_query($conn,$sql);
										while($mostrar=mysqli_fetch_array($result)){
										?>
                                        <tr>
                                            <td><?php echo $mostrar['CodigoProducto']?></td>
                                            <td><?php echo utf8_encode($mostrar['NombreProducto'])?></td>
                                            <td><?php echo utf8_encode($mostrar['Descripcion'])?></td>
                                            <td><?php echo $mostrar['PrecioUnitario']?></td>
                                            <td><?php echo $mostrar['Unidades']?></td>
                                            <td>
												<div class="text-center">
													<div class="btn-group">
														<a class="btn btn-warning" onclick="return modal_edit(<?php echo $mostrar['id']?>)" title="Editar"> 
														<i class ="fa fa-edit"></i>
														</a>  
														<a class="btn btn-danger" onclick="return modal_delete(<?php echo $mostrar['id']?>)" title="Eliminar"> 
														<i class ="fa fa-trash"></i>
														</a>  
												    </div>
												</div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo WEB_HOST.SYSTEM_PATH;?>logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- New product Modal-->
    <div class="modal fade" id="modal_new_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header" id="modal_product"> <!-- encabezado -->
			<h5 class="modal-title" id="exampleModalLabel"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body"> <!-- cuerpo -->
			<form action="<?php echo WEB_HOST.SYSTEM_PATH;?>admin/products/add.php" method="POST" id="formulario">

			  <div class="form-group">
				<input type="hidden" id="id" name="id">
			    <label for="CodigoProducto" class="col-form-label">Codigo del Producto</label>
				<input type="text" class="form-control" id="CodigoProducto" name="CodigoProducto">
				<label for="NombreProducto" class="col-form-label">Nombre del Producto</label>
				<input type="text" class="form-control" id="NombreProducto" name="NombreProducto">
				<label for="Descripcion" class="col-form-label">Descripcion del Producto</label>
				<input type="text" class="form-control" id="Descripcion" name="Descripcion">
				<label for="PrecioUnitario" class="col-form-label">Precio Unitario</label>
				<input type="text" class="form-control" id="PrecioUnitario" name="PrecioUnitario">
				<label for="Unidades" class="col-form-label">Unidades</label>
				<input type="text" class="form-control" id="Unidades" name="Unidades">
				<label for="Direccion" class="col-form-label">Dirección</label>
				<input type="text" class="form-control" id="Direccion" name="Direccion">

			  </div>
			  
			  <div class="modal-footer"> <!-- pie -->
				<input type="hidden" id="base_url" value="<?php echo WEB_HOST.SYSTEM_PATH;?>">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				<button type="button" class="btn btn-primary" id="register" name="register">Registrar</button>
			  </div>
			  
			</form>

		  </div>
		  
		</div>
	  </div>
	</div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>
    
    <!-- Sweet Alert -->
    <script src="../../vendor/sweetalert/js/sweetalert.min.js" rel="stylesheet"></script>
    
    <script src="../../assets/js/products.js"></script>

</body>

</html>
