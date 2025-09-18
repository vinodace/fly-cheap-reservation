<?php
          function createBreadcrumb() {
              // Your project root folder relative to localhost
              $projectRoot = '/ace-digital-solution/projects/September/flycheapreservation.com';

              $path = $_SERVER['REQUEST_URI']; // Full URL path
              $path = parse_url($path, PHP_URL_PATH); // Remove query string

              // Remove project root from path
              if (strpos($path, $projectRoot) === 0) {
                  $path = substr($path, strlen($projectRoot));
              }

              $pathParts = array_filter(explode('/', $path)); // Split and remove empty parts

              $breadcrumb = '<nav aria-label="breadcrumb"><ul class="breadcrumb-ullist_web1">';
              $breadcrumb .= '<li><a href="' . $projectRoot . '/"><i class="fa-solid fa-house"></i> Home</a></li>';

              $fullPath = $projectRoot;
              $i = 0;
              foreach ($pathParts as $part) {
                  $fullPath .= '/' . $part;
                  $label = ucwords(str_replace(['-', '_'], ' ', $part)); // Format label

                  if (++$i === count($pathParts)) {
                      $breadcrumb .= '<li class="active" aria-current="page">' . $label . '</li>';
                  } else {
                      $breadcrumb .= '<li class=""><a href="' . $fullPath . '">' . $label . '</a></li>';
                  }
              }

              $breadcrumb .= '</ul></nav>';
              return $breadcrumb;
          }

          // Usage
          echo createBreadcrumb();
          ?>