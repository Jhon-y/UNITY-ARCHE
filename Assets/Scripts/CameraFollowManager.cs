using UnityEngine;
using UnityEngine.SceneManagement;

public class SimpleCameraFollow : MonoBehaviour
{
    private void OnEnable()
    {
        SceneManager.sceneLoaded += OnSceneLoaded;
    }

    private void OnDisable()
    {
        SceneManager.sceneLoaded -= OnSceneLoaded;
    }

    private void OnSceneLoaded(Scene scene, LoadSceneMode mode)
    {
        GameObject player = GameObject.FindGameObjectWithTag("Player");
        if (player == null) return;

        var vcam = gameObject.GetComponent(typeof(MonoBehaviour));
        if (vcam != null)
        {
            var followProp = vcam.GetType().GetProperty("Follow");
            var lookAtProp = vcam.GetType().GetProperty("LookAt");

            if (followProp != null) followProp.SetValue(vcam, player.transform);
            if (lookAtProp != null) lookAtProp.SetValue(vcam, player.transform);
        }
    }
}