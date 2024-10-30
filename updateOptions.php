<?php
//      if ( !isset($new_instance['title']) && isset($options[$widget_number]) ) // user clicked cancel
 //       continue;
      $title = strip_tags(stripslashes($new_instance['title']));
      $showLinkCount= false ;
      if( isset($new_instance['showLinkCount']) ) {
        $showLinkCount= true ;
      }  
      $catSortOrder= 'ASC' ;
      if($new_instance['catSortOrder'] == 'DESC') {
        $catSortOrder= 'DESC' ;
      }
      if($new_instance['catSort'] == 'catName') {
        $catSort= 'catName' ;
      } elseif ($new_instance['catSort'] == 'catId') {
        $catSort= 'catId' ;
      } elseif ($new_instance['catSort'] == 'catSlug') {
        $catSort= 'catSlug' ;
      } elseif ($new_instance['catSort'] == 'catOrder') {
        $catSort= 'catOrder' ;
      } elseif ($new_instance['catSort'] == 'catCount') {
        $catSort= 'catCount' ;
      } elseif ($new_instance['catSort'] == '') {
        $catSort= '' ;
        $catSortOrder= '' ;
      }
      $linkSortOrder= 'ASC' ;
      if($new_instance['linkSortOrder'] == 'DESC') {
        $linkSortOrder= 'DESC' ;
      }
      if($new_instance['linkSort'] == 'linkName') {
        $linkSort= 'linkName' ;
      } elseif ($new_instance['linkSort'] == 'linkId') {
        $linkSort= 'linkId' ;
      } elseif ($new_instance['linkSort'] == 'linkRating') {
        $linkSort= 'linkRating' ;
      } elseif ($new_instance['linkSort'] == 'linkUrl') {
        $linkSort= 'linkUrl' ;
      } elseif ($new_instance['linkSort'] == '') {
        $linkSort= '' ;
        $linkSortOrder= '' ;
      }
      $expand= $new_instance['expand'];
      $customExpand= $new_instance['customExpand'];
      $customCollapse= $new_instance['customCollapse'];
      $inExclude= 'include' ;
      if($new_instance['inExclude'] == 'exclude') {
        $inExclude= 'exclude' ;
      }
      $animate=0;
      if( isset($new_instance['animate'])) {
        $animate= 1 ;
      }
      $nofollow=true;
      if( !isset($new_instance['nofollow'])) {
        $nofollow= false ;
      }
      $debug=0;
      if (isset($new_instance['debug'])) {
        $debug= 1 ;
      }
      $inExcludeCats=addslashes($new_instance['inExcludeCats']);
      $defaultExpand=addslashes($new_instance['defaultExpand']);
      $instance = compact(
          'title','showLinkCount','catSort','catSortOrder','defaultExpand',
          'expand','inExclude','inExcludeCats','linkSort','linkSortOrder',
          'animate', 'debug', 'nofollow', 'customExpand', 'customCollapse');

    //update_option('collapsLinkOptions', $options);
    //$updated = true;
?>
