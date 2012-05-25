<table width="100%">
	<tr>
		<td colspan="100">

		<div id="header">
					<table width="100%">
						<tr>
							<td width="27%"><h1>
									<img src="../media/logo.jpg" alt="<?php echo $app_init_data["SiteName"] ; ?>" />
								</h1></td>
							<td width="73%" align="right"><?php
								if ( intval ( $_SESSION["login_account_id"] ) > 0 )
								{
							?>
								<div >
									Login as : <?php echo $_SESSION["login_member_email"] ; ?>
									
									<br />
									<img src="../Admin/images/icons/stop.png" border="0" />
									<a href="logout.php" style="color:#ffffff; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
										
										Logout
									</a>
								</div>
								<?php
								}
							?>
							</td>
						</tr>
					</table>
					<br />
		<br />
		<br />
		<?php
			if ( $_SESSION["str_system_message"] != null )
			{
		?>
				<div class="system_message" style="clear:both;">
					<?php echo $_SESSION["str_system_message"] ; $_SESSION["str_system_message"] = null ; ?>
				</div>
				<?php
			}
		?>
		
					
					<br>
				</div>
		</td>
		
	</tr>
	
<tr>
	<td valign="top" width="20%">
		<?php
			if ( intval ( $_SESSION["login_account_id"] ) > 0 )
			{
		?>
			
				<div id="menu">
					<div align="left" style="background-image:none;">
						<img src="../Admin/images/icons/house.png" border="0" />
						<a href="home.php" class="menu_top_link">
						 Home
						</a>
						&nbsp; &nbsp; 
						<img src="../Admin/images/icons/world.png" border="0" />
						<a href="<?php echo base_url ?>" class="menu_top_link">
						 Visit Site
						</a>
					</div>
					
					
					<div >
					<img src="../Admin/images/icons/bell.png" />
					Classified
					<ul>
						<li>
							<img src="../Admin/images/icons/bell_go.png" border="0" alt="Base">
							<a href="<?php echo base_url ?>c-SelectCategory/">
								Add new Classified
							</a>
						</li>
						<li>
							<img src="../Admin/images/icons/bell_go.png" border="0" alt="Base">
							<a href="classifiedlist.php">
								
								All Classified Ads
							</a>
						</li>
						<li>
							<img src="../Admin/images/icons/bell_add.png" border="0" alt="Base">
							<a href="classifiedlist.php?st=1">
								
								Active Ads
							</a>
						</li>
						<li>
							<img src="../Admin/images/icons/bell_delete.png" alt="Base" height="16" border="0">
							<a href="classifiedlist.php?st=0">
								
								InActive Ads
							</a>
						</li>
						
						<li>
							<img src="../Admin/images/icons/bell_go.png" border="0" alt="Base">
							<a href="watchlist.php">
								My Watchlist
							</a>
						</li>
						
						
					</ul>
					</div>
					
					<div>
					<img src="../Admin/images/icons/user_suit.png" />
					Account
					<ul>
						<li>
							<img src="../Admin/images/icons/user_orange.png" border="0" alt="Base">
							<a href="ch_pass.php">
								
								Change Password
							</a>
						</li>
						<li>
							<img src="../Admin/images/icons/user_go.png" border="0" alt="Base">
							<a href="profile.php">
								
								Change Profile 
							</a>
						</li>
						
					</ul>
					</div>
					
					<div>
					<img src="../Admin/images/icons/email.png" />
					Messages
					<ul>
						<li>
							<img src="../Admin/images/icons/email_add.png" border="0" alt="Base">
							<a href="send_message.php">
								
								Send Message To Admin
							</a>
						</li>
						<li>
							<img src="../Admin/images/icons/email_attach.png" border="0" alt="Base">
							<a href="inbox.php">
								
								InBox
							</a>
						</li>
						
						
					</ul>
					</div>
					
				</div>
				<?php 
			}
		?>
	</td>
	<td>

	