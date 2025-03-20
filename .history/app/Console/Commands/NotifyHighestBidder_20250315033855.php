<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use App\Notifications\HighestBidNotification;
use Carbon\Carbon;

class NotifyHighestBidder extends Command
{
    protected $signature = 'auction:notify-highest-bid';
    protected $description = 'Notify admin about the highest bid for expired auctions';

    public function handle()
    {
        $expiredAuctions = Auction::where('end_date', '<', Carbon::now())->get();

        foreach ($expiredAuctions as $auction) {
            $highestBid = Bid::where('auction_id', $auction->id)->orderBy('bid_amount', 'desc')->first();
            
            if ($highestBid) {
                // Get admin users
                $admins = User::where('role', 'super admin')->get(); // Adjust based on your role system

                foreach ($admins as $admin) {
                    $admin->notify(new HighestBidNotification($highestBid));
                }
            }
        }

        $this->info('Admin notified about highest bids for expired auctions.');
    }
}
