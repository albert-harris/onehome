<div class="top-header ">    <div class="container">		<div class="clearfix">			<div class="visible-xs-block top-logo">				<img src="<?= Yii::app()->theme->baseUrl ?>/favicon.png" alt="" class="img-responsive"/>			</div>			<div class="top-links">				<?php if (Yii::app()->user->id): ?>					<ul class="links drop-right">						<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'); ?>"><span class="icon-user"></span> Welcome, <em><?php echo Yii::app()->user->first_name . ' ' . Yii::app()->user->last_name ?></em></a>							<?php if (Yii::app()->user->role_id == ROLE_REGISTER_MEMBER): ?>								<ul>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myprofile') ?>">My Profile</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myshortlist') ?>">My Shortlist</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>								</ul>							<?php elseif (Yii::app()->user->role_id == ROLE_TENANT): ?>								<ul>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/tenant/property') ?>">Properties</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/tenant/myprofile') ?>">My Profile</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/submitTestimonials') ?>">Submit Testimonials</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>								</ul>							<?php elseif (Yii::app()->user->role_id == ROLE_AGENT): ?>								<ul>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/dashboard') ?>">DashBoard</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/myprofile') ?>">My Profile</a></li>											<li><a href="<?php echo ProAgent::getForumLoginUrl(Yii::app()->user->id) ?>" target="_blank">Discussion Forum</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>								</ul>							<?php else: ?>								<ul>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/landlord/property') ?>">Properties</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/landlord/myprofile') ?>">My Profile</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/submitTestimonials') ?>">Submit Testimonials</a></li>									<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>								</ul>							<?php endif; ?>						</li>					</ul>				<?php else: ?>					<ul class="links">						<li><a href="javascript:void(0)"><span class="icon-user"></span> Client Login</a>							<ul>								<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/landlordlogin'); ?>">Landlord Login</a></li>								<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tenantlogin'); ?>">Tenant Login</a></li>							</ul>						</li>						<li><a href="javascript:void(0)"><span class="icon-user"></span> Agent Login</a>							<ul>								<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/agentlogin'); ?>">Onehome Agent login</a></li>							</ul>						</li>						<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>"><span class="icon-lock"></span> User Login</a></li>					</ul>					<ul class="links drop-right">						<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>"><span class="icon-user"></span> Register</a>						</li>					</ul>				<?php endif; ?>							</div>		</div>    </div></div><!-- header --><header class="header-container hidden-xs">    <div class="container">		<div class="row">			<div class="col-sm-3">				<div class="logo">					<a href="<?php echo Yii::app()->createAbsoluteUrl('site/home'); ?>">						<img src="<?php echo Yii::app()->theme->baseUrl ?>/img/logo.png" alt="One Home" class="img-responsive"/>					</a>				</div>							</div>			<div class="col-sm-9">				<?php $this->widget('AdsBannerTopWidget'); ?>			</div>		</div>      </div></header><!-- main menu --><div class="nav-container">	<nav class="navbar">		<div class="container-fluid">			<!-- Brand and toggle get grouped for better mobile display -->			<div class="navbar-header visible-xs-block text-center">				<a class="navbar-brand" href="javascrip:void(0)">Menu</a> 				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> 			</div>			<!-- Collect the nav links, forms, and other content for toggling -->			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">				<?php				$menuFe = new ShowMenu();				echo $menuFe->showNewMainMenu();				?> 			</div>			<!-- /.navbar-collapse -->		</div>		<!-- /.container-fluid -->	</nav></div>