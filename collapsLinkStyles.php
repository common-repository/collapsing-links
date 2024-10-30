<?php
$style="#sidebar span.collapsLink {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
} 

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsLink a.self {font-weight:bold}
#sidebar ul.collapsLinkList ul.collapsLinkList:before {content:'';} 
#sidebar ul.collapsLinkList li.collapsLink:before {content:'';} 
#sidebar ul.collapsLinkList li.collapsLink {list-style-type:none}
#sidebar ul.collapsLinkList li.collapsLinkItem {
       margin:0 0 0 2em;}
#sidebar ul.collapsLinkList li.collapsLinkItem:before {content: '\\\\00BB \\\\00A0' !important;} 
#sidebar ul.collapsLinkList li.collapsLink .sym {
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";

$default=$style;

$block="#sidebar ul.collapsLinkList li a {
            display:block;
            text-decoration:none;
            margin:0;
            padding:0;
            }
#sidebar ul.collapsLinkList li a:hover {
            background:#CCC;
            text-decoration:none;
          }
#sidebar span.collapsLink {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsLink a.self {background:#CCC;
                       font-weight:bold}
#sidebar ul.collapsLinkList ul.collapsLinkList:before {content:'';} 
#sidebar ul.collapsLinkList li.collapsLink {list-style-type:none}
#sidebar ul.collapsLinkList li.collapsLinkItem:before, 
  #sidebar ul.collapsLinkList li.collapsLink:before {
       content:'';
  } 
#sidebar ul.collapsLinkList li.collapsLink .sym {
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    float:left;
    padding-right:5px;
}
";

$noArrows="#sidebar span.collapsLink {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}
#sidebar li.collapsLink a.self {font-weight:bold}

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar ul.collapsLinkList li.collapsLinkItem:before {content:'';} 
#sidebar ul.collapsLinkList li.collapsLink:before {content:'';} 
#sidebar ul.collapsLinkList li.collapsLink {list-style-type:none}
#sidebar ul.collapsLinkList li.collapsLink .sym {
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";
$selected='default';
$custom=get_option('collapsLinkStyle');
?>
