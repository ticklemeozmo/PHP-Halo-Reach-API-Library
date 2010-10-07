<?php
	require_once('GlobalFunctions.php');
	class ReachFile{
		private $Author; //String
		private $CreateDate; //DateTime
		private $Description; //String
		private $FileCategory; //String
		private $FileDetailsUrl; //String
		private $FileId; //Integer
		private $MapId; //Integer
		private $ModifiedDate; //DateTime
		private $OriginalAuthor; //String
		private $RenderedWMVPath; //String
		private $RenderJobResolution; //String
		private $RenderJobStatus; //String
		private $ScreenshotFullSizeUrl; //String
		private $ScreenshotMediumUrl; //String
		private $ScreenshotThumbnailUrl; //String
		private $Title; //String
		
		public function __construct($File){
			$this->Author = $File->Author;
			$this->CreateDate = parseJSONDate($File->CreateDate);
			$this->Description = $File->Description;
			$this->FileCategory = $File->FileCategory;
			$this->FileDetailsUrl = $File->FileDetailsUrl;
			$this->FileId = $File->FileId;
			$this->MapId = $File->MapId;
			$this->ModifiedDate = parseJSONDate($File->ModifiedDate);
			$this->OriginalAuthor = $File->OriginalAuthor;
			$this->RenderedWMVPath = $File->RenderedWMVPath;
			$this->RenderJobResolution = $File->RenderJobResolution;
			$this->RenderJobStatus = $File->RenderJobStatus;
			$this->ScreenshotFullSizeUrl = $File->ScreenshotFullSizeUrl;
			$this->ScreenshotMediumUrl = $File->ScreenshotMediumUrl;
			$this->ScreenshotThumbnailUrl = $File->ScreenshotThumbnailUrl;
			$this->Title = $File->Title;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>