import logging
import time
from daemon import runner
from sync import S4Sync


class S4SyncApp(object):
    WAIT_TIME = 30  # sleep time between each iteration, in seconds

    def __init__(self):
        self.stdin_path = '/dev/null'
        self.stdout_path = '/dev/tty'
        self.stderr_path = '/dev/tty'
        self.pidfile_path =  '/var/run/s4sync.pid'
        self.pidfile_timeout = 5

    def run(self):
        s4sync = S4Sync()
        logger.info("S4Sync daemon started")
        while True:
            try:
                s4sync.sync()
            except:
                logger.exception("Unexpected error when trying to sync")
            time.sleep(self.WAIT_TIME)


# Logging
logger = logging.getLogger("s4sync")
LOG_LEVEL = logging.DEBUG
handler = logging.FileHandler("/var/log/s4sync.log")
formatter = logging.Formatter('%(asctime)s - %(name)s - %(levelname)s - %(message)s')
handler.setFormatter(formatter)
logger.addHandler(handler)
logger.setLevel(LOG_LEVEL)

# Python daemon preserving logger
app = S4SyncApp()
daemon_runner = runner.DaemonRunner(app)
daemon_runner.daemon_context.files_preserve=[handler.stream]
daemon_runner.do_action()
