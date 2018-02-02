<?php

namespace DevZone\Controller;

use Drone\Mvc\AbstractionController;
use Drone\FileSystem\Shell;
use Exception;

class Index extends AbstractionController
{
    public function index()
    {
        $config = include "module/DevZone/config/user.config.php";
        return $config;
    }

    public function development()
    {
        return [
            'modules'        => dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/module",
            'config'         => dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/config",
            'devzone_config' => include("module/DevZone/config/user.config.php")
        ];
    }

    public function count($file)
    {
        $file = fopen ($file, "r");

        $num_lines = 0;
        $characters = 0;

        while (!feof ($file))
        {
            if ($line = fgets($file))
            {
               $num_lines++;
               $characters += strlen($line);
            }
        }
        fclose ($file);

        return array(
            'lines'      => $num_lines,
            'characters' => $characters,
        );
    }

    public function countDirs($path)
    {
        $num_dirs = 0;

        if (is_dir($path))
        {
            if ($dh = opendir($path))
            {
                while (($file = readdir($dh)) !== false)
                {
                    $_file = $path."/".$file;
                    if (is_dir($_file) && $file!="." && $file!="..")
                        $num_dirs++;
                }
                closedir($dh);
            }
        }
        return $num_dirs;
    }

    public function countFiles($path)
    {
        $num_files = 0;
        if (is_dir($path))
        {
            if ($dh = opendir($path))
            {
                while (($file = readdir($dh)) !== false)
                {
                    $_file = $path."/".$file;
                    if (is_file($_file) && $file!="." && $file!="..")
                        $num_files++;
                }
                closedir($dh);
            }
        }
        return $num_files;
    }

    public function ls($path)
    {
        if (is_dir($path))
        {
            if ($dh = opendir($path))
            {
                while (($file = readdir($dh)) !== false)
                {
                    $_file = $path."/".$file;

                    if (basename($_file) == 'language')
                        continue;

                    $tag = (basename(dirname($_file)) == 'module') ? "<span class='badge badge-info'>module</span>" : "<span class='label label-default'>folder</span>";

                    if ($file!="." && $file!=".." && is_dir($_file))
                    {
                        $dirs = $this->countDirs($_file);
                        $files = $this->countFiles($_file);

                        $absolute_path = $path . '/'. $file;
                        $_path = str_replace($this->basePath, '', $absolute_path);

                        echo "<tr class='table-warning'><td>$absolute_path $tag</td><td><span class='badge badge-primary'>$dirs dirs</span></td><td><span class='badge badge-primary'>$files files</span></td></tr>";
                    }

                    echo "<tr class='table-success'>";

                    if (is_file($_file))
                    {
                        $data = $this->count($_file);

                        // Total count
                        $_SESSION["buffer"]["lines"] += $data["lines"];
                        $_SESSION["buffer"]["characters"] += $data["characters"];

                        echo "<td>$_file</td><td><span class='badge badge-danger'>" . $data["lines"] . " lines</span></td><td><span class='badge badge-success'>".$data["characters"]." characters</span></td>";
                    }

                    echo "</tr>";

                    if (is_dir($_file) && $file!="." && $file!="..")
                        $this->ls($path."/".$file);
                }
                closedir($dh);
            }
            else
                throw new Exception("Directory $path not available");
        }
    }
}