<?php
/*
Collapsing Links version: 0.4
Copyright 2007 Robert Felty

This work is largely based on the Collapsing Links plugin by Andrew Rader
(http://voidsplat.org), which was also distributed under the GPLv2. I have tried
contacting him, but his website has been down for quite some time now. See the
CHANGELOG file for more information.

This file is part of Collapsing Links

		Collapsing Links is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Links is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Links; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Helper functions

function list_links($args='') {
  global $wpdb;

  include('defaults.php');
  $options=wp_parse_args($args, $defaults);
  extract($options);
  if ($expand==1) {
    $expandSym='+';
    $collapseSym='—';
  } elseif ($expand==2) {
    $expandSym='[+]';
    $collapseSym='[—]';
  } elseif ($expand==3) {
    $expandSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/expand.gif' alt='expand' />";
    $collapseSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/collapse.gif' alt='collapse' />";
  } elseif ($expand==4) {
    $expandSym=htmlentities($customExpand);
    $collapseSym=htmlentities($customCollapse);
  } else {
    $expandSym='►';
    $collapseSym='▼';
  }
  if ($expand==3) {
    $expandSymJS='expandImg';
    $collapseSymJS='collapseImg';
  } else {
    $expandSymJS=$expandSym;
    $collapseSymJS=$collapseSym;
  }
	$inExclusions = '';
	if ( !empty($inExcludeCats) ) {
		$exterms = preg_split('/[,]+/',$inExcludeCats);
    if ($inExclude=='include') {
      $in='IN';
    } else {
      $in='NOT IN';
    }

		if ( count($exterms) ) {
			foreach ( $exterms as $exterm ) {
				if (empty($inExclusions))
					$inExclusions = "'" . sanitize_title($exterm) . "'";
				else
					$inExclusions .= ", '" . sanitize_title($exterm) . "' ";
			}
		}
	}
	if ( empty($inExclusions) ) {
		$inExcludeQuery = "";
  } else {
    $inExcludeQuery ="AND $wpdb->terms.slug $in ($inExclusions)";
  }

  $isPage='';
  if (get_option('collapsLinkIncludePages'=='no')) {
    $isPage="AND $wpdb->links.link_type='link'";
  }
  if ($catSort!='') {
    if ($catSort=='catName') {
      $catSortColumn="ORDER BY $wpdb->terms.name";
    } elseif ($catSort=='catId') {
      $catSortColumn="ORDER BY $wpdb->terms.term_id";
    } elseif ($catSort=='catSlug') {
      $catSortColumn="ORDER BY $wpdb->terms.slug";
    } elseif ($catSort=='catOrder') {
      $catSortColumn="ORDER BY $wpdb->terms.term_order";
    } elseif ($catSort=='catCount') {
      $catSortColumn="ORDER BY $wpdb->term_taxonomy.count";
    }
    $catSortOrder = $catSortOrder;
  } 
  if ($linkSort!='') {
    if ($linkSort=='linkName') {
      $linkSortColumn="ORDER BY l.link_name";
    } elseif ($linkSort=='linkId') {
      $linkSortColumn="ORDER BY l.link_id";
    } elseif ($linkSort=='linkUrl') {
      $linkSortColumn="ORDER BY l.url";
    } elseif ($linkSort=='linkRating') {
      $linkSortColumn="ORDER BY l.link_rating";
    }
    $linkSortOrder = $linkSortOrder;
  } 
	if ($defaultExpand!='') {
		$autoExpand = preg_split('/[,]+/',$defaultExpand);
  } else {
	  $autoExpand = array();
  }

  echo "\n    <ul class='collapsLinkList'>\n";

  $catquery = "SELECT $wpdb->term_taxonomy.count as 'count',
    $wpdb->terms.term_id, $wpdb->terms.name, $wpdb->terms.slug,
    $wpdb->term_taxonomy.parent, $wpdb->term_taxonomy.description FROM
    $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id =
    $wpdb->term_taxonomy.term_id  AND
    $wpdb->term_taxonomy.taxonomy = 'link_category' $inExcludeQuery
    $catSortColumn $catSortOrder";
  $linkquery="SELECT * FROM $wpdb->links l
      inner join $wpdb->term_relationships tr on l.link_id = tr.object_id
      inner join $wpdb->term_taxonomy tt on 
      tt.term_taxonomy_id = tr.term_taxonomy_id 
      inner join $wpdb->terms t on t.term_id = tt.term_id 
      WHERE tt.taxonomy='link_category' AND l.link_visible='Y' 
      $linkSortColumn $linkSortOrder";
  $cats = $wpdb->get_results($catquery);
  $links= $wpdb->get_results($linkquery); 

  if ($debug==1) {
    echo "<pre style='display:none' >";
    echo "catsort = $catSort\n";
    printf ("MySQL server version: %s\n", mysql_get_server_info());
    echo "CATEGORY QUERY: \n $catquery\n";
    echo "\nCATEGORY QUERY RESULTS\n";
    print_r($cats);
    echo "LINK QUERY:\n $linkquery\n";
    echo "\nLINK QUERY RESULTS\n";
    print_r($links);
    echo "\ncollapsLink options:\n";
    print_r($options[$number]);
    echo "</pre>";
  }
  $parents=array();
  foreach ($cats as $cat) {
    if ($cat->parent!=0) {
      array_push($parents, $cat->parent);
    }
  }
  
  foreach( $cats as $cat ) {
    $expanded='none';
    if (in_array($cat->name, $autoExpand) ||
        in_array($cat->slug, $autoExpand)) {
      $expanded='block';
    }
    $url = get_settings('siteurl');
    $home=$url;
    $lastLink= $cat->term_id;
    // print out linkegory name 
    if ( empty($cat->description) ) {
      $heading=$cat->name;
    } else {
      $heading=$cat->description;
    }
      
    $theCount=$cat->count;
    if ($theCount>0) {
        if ($expanded=='block') {
          print( "      <li class='collapsLink'><span title='click to
          collapse' class='collapsLink expand' onclick='expandCollapse(event,
          \"$expandSymJS\", \"$collapseSymJS\", $animate, \"collapsLink\"); return false'><span class='sym'>$collapseSym</span>" );
        } else {
          print( "      <li class='collapsLink'><span title='click to expand'
          class='collapsLink expand' onclick='expandCollapse(event,
          \"$expandSymJS\", \"$collapseSymJS\", $animate, \"collapsLink\"); return false'><span class='sym'>$expandSym</span> " );
        }
      if($showLinkCount){
        $heading .= ' (' . $theCount.')';
      }
        print( $heading ."</span>\n");
      // Now print out the link info
      if( ! empty($links) ) {
        echo "\n<ul id='collapsLink-" . $cat->term_id . 
            "' style=\"display:$expanded\">\n";
        foreach ($links as $link) {
          if ($link->term_id == $cat->term_id) {
            $name=$link->link_name;
						if ( empty($link->link_description) ) {
							$linkTitle=$link->link_name;
						} else {
							$linkTitle=$link->link_description;
						}
            $rel=$link->link_rel;
            if ($nofollow==1) {
              if ($rel!='') {
                $rel=trim($rel);
                $rel.=' ';
              }
              $rel.= 'nofollow';
            }
            $target = $link->link_target;
            if ( '' != $target )
              $target = ' target="' . $target . '"';
            echo "          <li class='collapsLinkItem'><a href='".
                $link->link_url."' title=\"$linkTitle\" $target" .
								" rel=\"$rel\" >" .
                strip_tags($link->link_name) . "</a></li>\n";
          }
        }
          // close <ul> and <li> before starting a new linkegory
        echo "        </ul>\n";
      echo "      </li> <!-- ending link -->\n";
      }
    } // end if theCount>0
  }
  echo "    </ul> <!-- ending collapsLink -->\n";
}
		echo "<script type=\"text/javascript\">\n";
		echo "// <![CDATA[\n";
    echo '/* These variables are part of the Collapsing Links Plugin 
*  Version: 0.4
*  $Id: collapsLinkList.php 1219254 2015-08-12 14:28:02Z robfelty $
* Copyright 2007-2009 Robert Felty (robfelty.com)
*/' . "\n";
    $expandSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/expand.gif' alt='expand' />";
    $collapseSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/collapse.gif' alt='collapse' />";
    echo "var expandSym=\"$expandSym\";\n";
    echo "var collapseSym=\"$collapseSym\";\n";
    echo"
    collapsAddLoadEvent(function() {
      autoExpandCollapse('collapsLink');
    });
    ";
		echo "// ]]>\n</script>\n";
?>
