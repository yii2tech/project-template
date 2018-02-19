<?php

namespace app\controllers\console;

use app\models\db\BlogPost;
use app\models\filedb\Language;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii2tech\sitemap\File;
use yii2tech\sitemap\IndexFile;

/**
 * SitemapController handles generation of the sitemap files.
 *
 * Make sure you keep [[actionGenerate()]] up-to-date, including all pages from your project,
 * which should appear at sitemap.
 */
class SitemapController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $defaultAction = 'generate';


    /**
     * Generates sitemap files.
     */
    public function actionGenerate()
    {
        if (!$this->acquireMutex()) {
            $this->stderr("Execution terminated: command is already running.\n", Console::FG_RED);
            return ExitCode::USAGE;
        }

        $this->stdout("Generating sitemap files...\n");

        $siteMapBasePath = Yii::getAlias('@app/web/sitemap');

        // delete existing sitemap :
        foreach (FileHelper::findFiles($siteMapBasePath, ['only' => ['*.xml']]) as $existingSitemapFile) {
            unlink($existingSitemapFile);
        }

        $siteMapFile = new File();
        $siteMapFile->fileBasePath = $siteMapBasePath;
        $siteMapFile->fileName = 'sitemap.xml';

        $siteMapFile->writeUrl(['site/index'], ['priority' => '0.9', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
        $siteMapFile->writeUrl(['site/about'], ['priority' => '0.8', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);

        $siteMapFile->writeUrl(['auth/login'], ['priority' => '0.5', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
        $siteMapFile->writeUrl(['auth/request-password-reset'], ['priority' => '0.5', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);

        $siteMapFile->writeUrl(['signup/index'], ['priority' => '0.9', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);

        $siteMapFile->writeUrl(['help/contact'], ['priority' => '0.7', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
        $siteMapFile->writeUrl(['help/faq'], ['priority' => '0.7', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);

        /*$siteMapFile->writeUrl(['blog/index'], ['priority' => '0.9', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        foreach ($blogPosts as $blogPost) {
            $siteMapFile->writeUrl(
                [
                    'blog/view',
                    'id' => $blogPost->id,
                    'slug' => $blogPost->slug,
                ],
                [
                    'priority' => '0.7',
                    'changeFrequency' => File::CHECK_FREQUENCY_MONTHLY,
                    'lastModified' => $blogPost->date,
                ]
            );
        }*/

        $this->stdout("Sitemap generation is complete.\n");

        $this->releaseMutex();

        return ExitCode::OK;
    }

    /**
     * @return \yii\mutex\Mutex mutex component
     */
    protected function getMutex()
    {
        return Yii::$app->get('mutex');
    }

    /**
     * Acquires current action lock.
     * @return bool lock acquiring result.
     */
    protected function acquireMutex()
    {
        return $this->getMutex()->acquire($this->composeMutexName());
    }

    /**
     * Release current action lock.
     * @return bool lock release result.
     */
    protected function releaseMutex()
    {
        return $this->getMutex()->release($this->composeMutexName());
    }

    /**
     * Composes the mutex name.
     * @return string mutex name.
     */
    protected function composeMutexName()
    {
        return get_class($this) . '::' . $this->action->getUniqueId();
    }
}