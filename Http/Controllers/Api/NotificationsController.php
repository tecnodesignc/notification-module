<?php

namespace Modules\Notification\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Api\BaseApiController;
use Modules\Notification\Entities\Notification;
use Modules\Notification\Repositories\NotificationRepository;
use Modules\Notification\Transformers\NotificationTransformer;

class NotificationsController extends BaseApiController
{
    /**
     * @var NotificationRepository
     */
    private NotificationRepository $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function markAsRead(Request $request): JsonResponse
    {
        $updated = $this->notification->markNotificationAsRead($request->get('id'));

        return response()->json(compact('updated'));
    }

    public function index()
    {
        $notifications = $this->notification->allForUser($this->auth->id());

        return view('notification::admin.notifications.index', compact('notifications'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Notification $notification
     * @return Response
     */
    public function destroy(Notification $notification): Response
    {
        $this->notification->destroy($notification);

        return redirect()->route('admin.notification.notification.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => 'Notification']));
    }

    public function destroyAll()
    {
        $this->notification->deleteAllForUser($this->auth->id());

        return redirect()->route('admin.notification.notification.index')
            ->withSuccess(trans('notification::messages.all notifications deleted'));
    }

    public function markAllAsRead()
    {
        $this->notification->markAllAsReadForUser($this->auth->id());

        return redirect()->route('admin.notification.notification.index')
            ->withSuccess(trans('notification::messages.all notifications marked as read'));
    }
}
