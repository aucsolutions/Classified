<?php
	if ( intval ( $totalRecords ) == 0 )
		$totalRecords = $data->get_num_records ( ) ;
	$totalPages = ceil ( $totalRecords / $pageSize ) ;
?>
<tr class="listing_paging">
	<td align="left" colspan="3">
		Showing page # <strong><?php echo intval ( $_GET["p"] ) + 1 ?></strong> of <strong><?php echo $totalPages ?></strong> with Total Records : <strong><?php echo $totalRecords ?></strong>
	</td>
	<td colspan="100" align="right">
		<?php
			if ( $totalRecords > $pageSize )
			{
				for ( $i = 0 ; $i < $totalPages ; $i++ )
				{
					echo "<a href='?p=$i".get_query_string_vars("p")."' class='pagination_link'>".($i+1)."</a>" ;
				}
			}
		?>
	</td>
</tr>