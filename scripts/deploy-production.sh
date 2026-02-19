#!/usr/bin/env bash
set -euo pipefail

DEPLOY_HOST="iad1-shared-b7-32.dreamhost.com"
DEPLOY_USER="normanlove"
DEPLOY_PORT="22"
DEPLOY_PATH="norman-love.com/lunar"
BRANCH="main"

REMOTE_CMD="cd ~/${DEPLOY_PATH} && git fetch origin ${BRANCH} && git checkout ${BRANCH} && git pull --ff-only origin ${BRANCH}"

echo "Deploying ${BRANCH} to ${DEPLOY_USER}@${DEPLOY_HOST}:~/${DEPLOY_PATH}"
ssh -p "${DEPLOY_PORT}" "${DEPLOY_USER}@${DEPLOY_HOST}" "${REMOTE_CMD}"
echo "Deploy complete."
