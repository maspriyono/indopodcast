<?php namespace App\Console\Commands;
use App\Item;
use App\Podcast;
use DB;
use Feeds;
use Illuminate\Console\Command;

class UpdatePodcastItems extends Command {
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'updatePodcastItems';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update podcast items daily at 5 AM - from RSS feeds';

	/**
	 * Update podcast items
	 *
	 * @return mixed
	 */
	public function handle() {
		$this->info('Initiating podcasts discovery...');
		$uniquePodcasts = DB::table('podcasts')
			->select('id', 'feed_url', 'machine_name')
			->groupBy('machine_name')->get();
		$i = 0;
		foreach ($uniquePodcasts as $podcast) {
			$usersSubscribedToThisPodcast = DB::table('podcasts')
				->select('user_id', 'id as podcast_id')
				->where('machine_name', '=', $podcast->machine_name)
				->get();
			$this->info('checking: ' . $podcast->feed_url);
			try {
			$items = Feeds::make($podcast->feed_url)->get_items();
			$this->info('1');

			// Calculate 48 hours ago
			$yesterday = time() - (24 * 2 * 60 * 60);
			$j = 0;

			foreach ($items as $item) {
				$this->info('itm pub date: ' . $item->get_date());
				$itemPubDate = $item->get_date();

				if ($item->get_date('U') > $yesterday) {

					// new items
					foreach ($usersSubscribedToThisPodcast as $subscriber) {

						$podcastItemsCount = DB::table('items')
							->select('user_id', 'title', 'podcast_id')
							->where('title', '=', strip_tags($item->get_title()))
							->where('user_id', '=', $subscriber->user_id)
							->where('podcast_id', '=', $subscriber->podcast_id)
							->count();

						// if this item is not already in the DB
						if ($podcastItemsCount == 0) {
							Item::create([
								'user_id' => $subscriber->user_id,
								'title' => strip_tags($item->get_title()),
								'description' => strip_tags(str_limit($item->get_description(), 100)),
								'published_at' => $item->get_date('Y-m-d'),
								'url' => $item->get_permalink(),
								'audio_url' => $item->get_enclosure()->get_link(),
								'podcast_id' => $subscriber->podcast_id,
							]);

							$j++;
							$i++;
						}
					}
				} else {
					break;
				}

				$this->info('added new ' . $j . ' items');
			}
			$this->info('total ' . $i . ' items addition');
			} catch (\Exception $e) {
				$this->error($e);	
			}
		}
		$this->info('Discovery has been done successfully...');
	}
}
