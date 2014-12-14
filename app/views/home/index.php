<div id="wr">
<div id="hd"></div>
<div id="cnt">
	<h2>Search for the book</h2>
	<form id="search_form" name="search_form" method="get" action="#">
		<table>
			<tr>
				<th scope="row"><label for="srch_form">Search for:</label></th>
				<td>
					<input type="text" name="srch_for" id="srch_for" class="f_fld"
					value="<?php echo isset($_GET['srch_for']) ? $_GET['srch_for'] : ''?>">
				</td>
				<th><label for="srch_category">Category:</label></th>
				<td><?php $this->view->dropdown(array(
							'name' => 'srch_category',
							'id' => 'srch_category',
							'default' => 'Any Category',
							//'selectedval' => $,
							'data' => $categories));?></td>
			</tr>
			<tr>
				<th scope="row">Cover type:</th>
				<td><?php 
						$this->view->radiobutton(array(
							'name' => 'srch_cover',
							'id' => 'srch_cover',
							'default' => 'Any',
							//'keyval' => 'year',
							//'nameval' => 'year',
							//'selectedval' => $authors[1],
							'data' => $covers)); ?></td>
				<th><label for="srch_author">Author:</label></th>
				<td>
					<?php $this->view->dropdown(array(
							'name' => 'srch_author',
							'id' => 'srch_author',
							'default' => 'Any Authors',
							'data' => $authors));?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="srch_language">Language:</label></th>
				<td>
					<?php 
						$this->view->dropdown(array(
						'name' => 'srch_language',
						'id' => 'srch_language',
						'default' => 'Any languages',
						//'selectedval' => $langs[1],
						'data' => $langs
					));?>
				</td>
				<th><label for="srch_year">Year:</label></th>
				<td><?php $this->view->dropdown(array(
						'name' => 'srch_year',
						'id' => 'srch_year',
						'default' => 'Any Years',
						'keyval' => 'year',
						'nameval' => 'year',
						//'selectedval' => $years[1],
						'data' => $years));?></td>
			</tr>
			<tr>
				<th scope="row">Available in:</th>
				<td colspan="3">
				<?php $this->view->checkbox(array(
						'name' => 'srch_locations',
						'id' => 'srch_locations',
						//'default' => 'Any Years',
						//'keyval' => 'year',
						//'nameval' => 'year',
						//'selectedval' => $years[1],
						'data' => $locations));?>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<label for="btn" class="sbm fl_r">
						<input type="submit" id="btn" value="Search" />
					</label>
				</td>
			</tr>
		</table>
	</form>
	<?php if ($search): ?>
		<table border="0" celspacing="0" celpadding="0">
			<tr>
				<th scope="col">Book title</th>
				<th scope="col" class="col_15">Category</th>
				<th scope="col" class="col_15">Author</th>
				<th scope="col" class="col_10 al_r">Year</th>
				<th scope="col" class="col_10 al_r">Price</th>
			</tr>
			<?php foreach ($search as $k ): ?>
				<tr>
					<td><?php echo $k['Title'] ?></td>
					<td><?php echo $k['Category'] ?></td>
					<td><?php echo $k['Author'] ?></td>
					<td><?php echo $k['Year'] ?></td>
					<td><?php echo $k['Price'] ?></td>
				</tr>
			<?php endforeach ?>
		</table>
	<?php elseif(count($_GET) > 0): ?>
	<p>
		There are no records matching for your criteria.
	</p>
	<?php else: ?>
		<p>
			Theree are currently no records available.
		</p>
	<?php endif ?>
</div>
</div>