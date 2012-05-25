
<table width="100%">
	<tr>
		<td colspan="100">
			<div id="header">
			<table width="100%">
					<tr>
						<td width="27%"><h1>
								<img src="../media/logo.jpg" alt="Your Logo here" />
							</h1></td>
						<td width="73%" align="right"><?php
							if ( intval ( $_SESSION["login_admin_id"] ) > 0 )
							{
						?>
							<div >
								Login as : <?php echo $_SESSION["login_admin_email"] ; ?>
								<br />
								<br />
	
								<a href="ch_pass.php" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
									Change Password
								</a>
								<br />
								<a href="logout.php" style="color:#ffffff; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
									<img src="images/icons/stop.png" border="0" />
									Logout
								</a>
							</div>
							<?php
							}
						?>
						</td>
					</tr>
				</table>
				</div>
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


		</td>
	</tr>
	<tr>
		<td valign="top" width="20%">
			
			
			

			<?php
		if ( intval ( $_SESSION["login_admin_id"] ) > 0 )
		{
	?>
		
			<div id="menu">
				<div align="left" style="background-image:none;">
					<img src="images/icons/house.png" border="0" />
					<a href="home.php" class="menu_top_link">
					 Home
					</a>
					&nbsp; &nbsp; 
					<img src="images/icons/world.png" border="0" />
					<a href="<?php echo base_url ?>" class="menu_top_link" target="_blank">
					 Visit Site
					</a>
				</div>
				<?php
				if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
				{
			?>
				<div >
				<img src="images/icons/application_xp_terminal.png" />
				General Settings
				<ul>
					<li>
						<img src="images/icons/table.png" border="0" alt="Base">
						<a href="sitesettings.php">
							
							General  Settings
						</a>
					</li>
					<li>
						<img src="images/icons/database_table.png" border="0" alt="Base">
						<a href="googleads.php">
							
							Banners
						</a>
					</li>
					<li>
						<img src="images/icons/table_sort.png" border="0" alt="Base">
						<a href="listing.php">
							
							Listing Settings
						</a>
					</li>
					
					<li>
						<img src="images/icons/table_sort.png" border="0" alt="Base">
						<a href="theme.php">
							
							Site Themes
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_page"] ) > 0 )
				{
			?>
				<div>
				<img src="images/icons/page_copy.png" />
				Static Page
				<ul>
					<li>
						<img src="images/icons/page_add.png" border="0" alt="Base">
						<a href="s_page.php">
							
							Add New
						</a>
					</li>
					<li>
						<img src="images/icons/page_copy.png" border="0" alt="Base">
						<a href="s_pages.php">
							
							Pages List
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_category"] ) > 0 )
				{
			?>
				<div >
				<img src="images/icons/chart_organisation.png" />
				Category
				<ul>
					<li>
						<img src="images/icons/chart_organisation_add.png" border="0" alt="Base">
						<a href="category.php">
							
							Add Category
						</a>
					</li>
					<li>
						<img src="images/icons/database_table.png" border="0" alt="Base">
						<a href="catlist.php">
							
							Category List
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_ad"] ) > 0 )
				{
			?>
				<div >
				<img src="images/icons/bell.png" />
				Classified
				<ul>
					<li>
						<img src="images/icons/bell_go.png" border="0" alt="Base">
						<a href="classifiedlist.php">
							
							All Classified Ads
						</a>
					</li>
					<li>
						<img src="images/icons/bell_add.png" border="0" alt="Base">
						<a href="classifiedlist.php?st=1">
							
							Active Ads
						</a>
					</li>
					<li>
						<img src="images/icons/bell_delete.png" alt="Base" height="16" border="0">
						<a href="classifiedlist.php?st=0">
							
							InActive Ads
						</a>
					</li>
					<li>
						<img src="images/icons/wrench_orange.png" alt="Base" height="16" border="0">
						<a href="classified_settings.php">
							
							Settings
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_account"] ) > 0 )
				{
			?>
				<div>
				<img src="images/icons/user_suit.png" />
				Accounts
				<ul>
					<li>
						<img src="images/icons/user_orange.png" border="0" alt="Base">
						<a href="accounts.php">
							
							All Users
						</a>
					</li>
					<li>
						<img src="images/icons/user_go.png" border="0" alt="Base">
						<a href="accounts.php?st=1">
							
							Active Users
						</a>
					</li>
					<li>
						<img src="images/icons/user_delete.png" alt="Base" height="16" border="0">
						<a href="accounts.php?st=0">
							
							Banned User
						</a>
					</li>
					<li>
						<img src="images/icons/user_add.png" alt="Base" height="16" border="0">
						<a href="admin.php">
							
							Add Administrator
						</a>
					</li>
					<li>
						<img src="images/icons/user_red.png" alt="Base" height="16" border="0">
						<a href="adminlist.php">
							
							All Administrator
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_payment"] ) > 0 )
				{
			?>
				<div>
				<img src="images/icons/coins.png" />
				Payments
				And Plans
				<ul>
					<li>
						<img src="images/icons/coins.png" border="0" alt="Base">
						<a href="paymentlist.php">
							
							Recieved
						</a>
					</li>
					<li>
						<img src="images/icons/coins_add.png" border="0" alt="Base">
						<a href="payment.php">
							
							Settings
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
				{
			?>
				<div>
				<img src="images/icons/email.png" />
				Emails
				<ul>
					<li>
						<img src="images/icons/email_add.png" border="0" alt="Base">
						<a href="emails.php?type=confirm">
							
							AD confirmation
						</a>
					</li>
					<li>
						<img src="images/icons/email_attach.png" border="0" alt="Base">
						<a href="emails.php?type=registration">
							
							Registration
						</a>
					</li>
					
				</ul>
				</div>
				<?php
				}
				
				
			?>
				<div>
				<img src="images/icons/email.png" />
				Geographic Management
				<ul>
					<li>
						<img src="images/icons/application.png" alt="Base" border="0">
						<a href="country.php">
							
							Add Country
						</a>
					</li>
					<!--
					<li>
						<img src="images/icons/application_double.png" alt="Base" width="16" height="16" border="0">
						<a href="state.php">
							
							Add State/Province
						</a>
					</li>
					<li>
						<img src="images/icons/application_cascade.png" alt="Base" width="16" height="16" border="0">
						<a href="city.php">
							
							Add City/Coutry
						</a>
					</li>
					<li>
						<img src="images/icons/cog_edit.png" alt="Base" height="16" border="0">
						<a href="regions.php">
							
							Geographic List
						</a>
					</li>
					-->
				</ul>
				</div>
				<div>
				<img src="images/icons/email.png" />
				Messages
				<ul>
					<li>
						<img src="images/icons/application.png" alt="Base" border="0">
						<a href="inbox.php">
							
							Inbox
						</a>
					</li>
										<li>
					<img src="images/icons/application.png" alt="Base" border="0">
						<a href="support.php">
							
							Support Center
						</a>
					</li>
					
						<li>
					<img src="images/icons/application.png" alt="Base" border="0">
						<a href="updates.php">
							
							Update Checker
						</a>
					</li>
				</ul>
				</div>
			</div>
			<?php 
		}
	?>
			<br>
		
		</td>
		<td valign="top" align="left">
		
		


